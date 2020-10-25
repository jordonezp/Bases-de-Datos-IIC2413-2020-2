CREATE OR REPLACE FUNCTION
search_dock_permit_availability(pid_input INT, day_in DATE, plate_in VARCHAR)
RETURNS VARCHAR AS $avbty$ 
DECLARE 
    d_capacity INT;
    occupancy INT;
    available_fid INT;
    d_fid INT;
    d_tuple RECORD;
BEGIN

    available_fid := -1;
    
    FOR d_tuple IN 
    SELECT * FROM facilities NATURAL JOIN docks
    WHERE pid = pid_input LOOP

        d_fid := d_tuple.fid;
        d_capacity := d_tuple.capacity;

        SELECT COUNT(1) INTO occupancy 
        FROM get_permits_for_facility_for_date(d_fid, day_in);

        IF occupancy < d_capacity THEN
            available_fid := d_fid;
        END IF;

    END LOOP;

    IF available_fid >= 0 THEN
        PERFORM insert_dock_permit(available_fid, plate_in, day_in, '-');
        RETURN 'available';
    ELSE 
        RETURN 'unavailable';
    END IF;

END;
$avbty$
LANGUAGE plpgsql;
