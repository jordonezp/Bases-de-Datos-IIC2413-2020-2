CREATE OR REPLACE FUNCTION
get_permits_for_day_for_facility(day_input timestamp, fid_input int)
RETURNS VARCHAR AS $f_type$ 
DECLARE 
    f_type VARCHAR;
BEGIN
    SELECT facilities.type INTO f_type FROM facilities WHERE fid = fid_input;

    IF f_type = 'dock' THEN 
        RAISE NOTICE 'this is dock';
        
    ELSIF f_type = 'shipyard' THEN
        RAISE NOTICE 'this is shipyard';
    ELSE
        RAISE NOTICE 'doesnt exist';
    END IF;
    RETURN f_type;
END;
$f_type$
LANGUAGE plpgsql;