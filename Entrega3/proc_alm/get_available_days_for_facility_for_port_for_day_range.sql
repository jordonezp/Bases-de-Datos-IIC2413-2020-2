CREATE OR REPLACE FUNCTION
get_available_days_for_facility_for_port_for_day_range(pid_input INT, day_start DATE, day_end DATE)
RETURNS TABLE (fid INT, available_day DATE) AS $$ 
DECLARE 
    curr_permit_count INT;
    curr_date DATE;
    f_capacity INT;
    curr_ocupied INT;
    fid_input INT;
    f_tuple RECORD;
BEGIN

    DELETE FROM available_days_for_facility_for_port_for_day_range_cache WHERE TRUE;

    FOR f_tuple IN 
    SELECT * FROM facilities 
    WHERE pid = pid_input LOOP

        fid_input := f_tuple.fid;

        SELECT capacity INTO f_capacity 
        FROM facilities 
        WHERE facilities.fid = fid_input;
        
        IF NOT FOUND THEN 
            RAISE EXCEPTION 'facility % not found', fid_input;
        END IF;
        
        curr_date := day_start;
        WHILE curr_date <= day_end LOOP
            SELECT COUNT(1) INTO curr_ocupied 
            FROM get_permits_for_facility_for_date(fid_input, curr_date);

            IF curr_ocupied < f_capacity THEN
                RAISE NOTICE 'available_day';
                INSERT INTO available_days_for_facility_for_port_for_day_range_cache VALUES (fid_input, curr_date);
            ELSE 
                RAISE NOTICE 'occupied day';
            END IF;
            
            curr_date := curr_date + 1;
        END LOOP;

    END LOOP;

    RETURN QUERY SELECT * FROM available_days_for_facility_for_port_for_day_range_cache;
END;
$$
LANGUAGE plpgsql;
