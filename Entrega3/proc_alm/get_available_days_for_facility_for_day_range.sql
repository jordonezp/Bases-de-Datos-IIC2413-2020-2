CREATE OR REPLACE FUNCTION
get_available_days_for_facility_for_day_range(fid_input INT, day_start DATE, day_end DATE)
RETURNS TABLE (date_out DATE) AS $$ 
DECLARE 
    permit_count INT;
    curr_date DATE;
    f_capacity INT;
    curr_ocupied INT;
BEGIN

    DELETE FROM available_days_for_facility_cache WHERE TRUE;

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
            -- RAISE NOTICE 'available_day';
            INSERT INTO available_days_for_facility_cache VALUES (curr_date);
        ELSE 
            -- RAISE NOTICE 'occupied day';
        END IF;
        
        curr_date := curr_date + 1;
    END LOOP;
    RETURN QUERY SELECT * FROM available_days_for_facility_cache;
END;
$$
LANGUAGE plpgsql;
