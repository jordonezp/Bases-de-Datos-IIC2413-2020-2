CREATE OR REPLACE FUNCTION
insert_dock_permit(fid INT, license_plate VARCHAR, arrival_date TIMESTAMP, description VARCHAR)
-- peid fid license_plate arrival_date description
RETURNS VOID AS $$
    DECLARE
        new_peid INT;
    BEGIN
        SELECT MAX(peid) INTO new_peid
        FROM permits;

        new_peid := new_peid + 1;

        INSERT INTO permits VALUES (new_peid, fid, license_plate, arrival_date);
        INSERT INTO dock_permits VALUES (new_peid, description);

    END;
$$
LANGUAGE plpgsql;