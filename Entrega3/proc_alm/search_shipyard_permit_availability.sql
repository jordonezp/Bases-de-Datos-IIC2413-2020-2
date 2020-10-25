CREATE OR REPLACE FUNCTION
search_shipyard_permit_availability(pid_input INT, day_in DATE, day_out DATE, plate_in VARCHAR)
RETURNS VARCHAR AS $avbty$ 
DECLARE 
    s_capacity INT;
    occupancy INT;
    available_fid INT;
    s_fid INT;
    s_tuple RECORD;
    curr_date DATE;
    has_full_day BOOLEAN;
BEGIN

    available_fid := -1;
    
    FOR s_tuple IN 
    SELECT * FROM facilities NATURAL JOIN shipyards
    WHERE pid = pid_input LOOP

        s_fid := s_tuple.fid;
        s_capacity := s_tuple.capacity;

        curr_date := day_in;
        has_full_day := FALSE;
        WHILE curr_date <= day_out LOOP
            SELECT COUNT(1) INTO occupancy 
            FROM get_permits_for_facility_for_date(s_fid, curr_date);

            IF occupancy >= s_capacity THEN
                has_full_day := TRUE;
            END IF;
            curr_date := curr_date + 1;
        END LOOP;

        IF NOT has_full_day THEN
            available_fid := s_fid;
        END IF; 

    END LOOP;

    IF available_fid >= 0 THEN
        PERFORM insert_shipyard_permit(available_fid, plate_in, day_in, day_out);
        RETURN 'available';
    ELSE 
        RETURN 'unavailable';
    END IF;

END;
$avbty$
LANGUAGE plpgsql;
