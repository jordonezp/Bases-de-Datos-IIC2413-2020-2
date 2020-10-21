CREATE OR REPLACE FUNCTION
get_permits_for_facility_for_date(fid_input INT, day_input DATE)
RETURNS TABLE (peid INT, date_out DATE) AS $$ 
DECLARE 
    permit_count INT;
BEGIN
    IF EXISTS (SELECT 1 FROM docks WHERE docks.fid = fid_input) THEN 
        RAISE NOTICE 'is dock';
        RETURN QUERY EXECUTE 
            'SELECT permits.peid, DATE(permits.arrival_date) FROM permits 
            NATURAL JOIN get_permits_for_facility($1) 
            NATURAL JOIN dock_permits
            WHERE DATE(permits.arrival_date) = $2'
            USING fid_input, day_input;
    ELSIF EXISTS (SELECT 1 FROM shipyards WHERE shipyards.fid = fid_input) THEN
        RAISE NOTICE 'is shipyard';
        RETURN QUERY EXECUTE 
            'SELECT permits.peid, DATE(permits.arrival_date) FROM permits 
            NATURAL JOIN get_permits_for_facility($1) 
            NATURAL JOIN shipyard_permits
            WHERE DATE(permits.arrival_date) <= $2 
            AND $2 <= DATE(shipyard_permits.depart_date)'
            USING fid_input, day_input;
    ELSE
        RAISE EXCEPTION 'Nonexistent ID for facility ---> %', fid_input;
    END IF;
    RETURN QUERY EXECUTE 'SELECT peid, DATE(arrival_date) FROM permits WHERE FALSE';
END;
$$
LANGUAGE plpgsql;