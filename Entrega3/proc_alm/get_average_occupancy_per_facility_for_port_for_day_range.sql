CREATE OR REPLACE FUNCTION
get_average_occupancy_per_facility_for_port_for_day_range(pid_input INT, day_start DATE, day_end DATE)
RETURNS TABLE (fid INT, occupancy INT) AS $$ 
DECLARE 
    permit_count INT;
    curr_date DATE;
    f_capacity INT;
    curr_ocupied INT;
    total_sum INT;
    days_diff INT;
    percent INT;
    total_spots INT;
    fid_input INT;
    f_tuple RECORD;
BEGIN

    DELETE FROM get_average_occupancy_per_facility_for_port_for_day_range_cache WHERE TRUE;

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

        days_diff := day_end - day_start + 1;
        total_spots :=  days_diff * f_capacity;
        total_sum := 0;
        
        curr_date := day_start;
        WHILE curr_date <= day_end LOOP
            SELECT COUNT(1) INTO curr_ocupied 
            FROM get_permits_for_facility_for_date(fid_input, curr_date);

            total_sum := total_sum + curr_ocupied;
            
            curr_date := curr_date + 1;
        END LOOP;
        percent = FLOOR(total_sum*100/total_spots);
        
        INSERT INTO get_average_occupancy_per_facility_for_port_for_day_range_cache 
        VALUES (fid_input, percent);

        END LOOP;

    RETURN QUERY SELECT * FROM get_average_occupancy_per_facility_for_port_for_day_range_cache;
END;
$$
LANGUAGE plpgsql;
