CREATE OR REPLACE FUNCTION
get_permits_for_day_for_facility(day_input timestamp, fid_input int)
RETURNS TABLE (peid INT) AS $$ 
DECLARE 
    f_type VARCHAR;
BEGIN
    SELECT facilities.type INTO f_type FROM facilities WHERE fid = fid_input;

    IF f_type = 'dock' THEN 
        RAISE NOTICE 'this is dock';
        RETURN QUERY EXECUTE 
            'SELECT peid 
            FROM permits NATURAL JOIN dock_permits
            WHERE permits.fid = $1
            AND date(permits.arrival_date) = $2'
            USING fid_input, day_input;
    ELSIF f_type = 'shipyard' THEN
        RAISE NOTICE 'this is shipyard';
        RETURN QUERY EXECUTE 'SELECT peid FROM permits NATURAL JOIN shipyard_permits';
    ELSE
        RAISE NOTICE 'doesnt exist';
    END IF;
    RETURN QUERY EXECUTE 'SELECT peid FROM permits WHERE FALSE';
END;
$$
LANGUAGE plpgsql;