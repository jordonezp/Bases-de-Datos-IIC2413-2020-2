CREATE OR REPLACE FUNCTION
get_permits_for_facility(fid_input int)
RETURNS TABLE (peid INT) AS $$ 
DECLARE 
    f_type VARCHAR;
BEGIN
    IF EXISTS (SELECT 1 FROM docks WHERE docks.fid = fid_input) THEN 
        -- RAISE NOTICE 'is dock';
        RETURN QUERY EXECUTE 
            'SELECT peid 
            FROM dock_permits NATURAL JOIN permits
            WHERE permits.fid = $1'
            USING fid_input;
    ELSIF EXISTS (SELECT 1 FROM shipyards WHERE shipyards.fid = fid_input) THEN
        -- RAISE NOTICE 'is shipyard';
        RETURN QUERY EXECUTE 
            'SELECT peid 
            FROM shipyard_permits NATURAL JOIN permits
            WHERE permits.fid = $1'
            USING fid_input;
    ELSE
        RAISE EXCEPTION 'Nonexistent ID for facility ---> %', fid_input;
    END IF;
    RETURN QUERY EXECUTE 'SELECT peid FROM permits WHERE FALSE';
END;
$$
LANGUAGE plpgsql;