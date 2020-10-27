CREATE OR REPLACE FUNCTION
insert_shipyard_permit(fid INT, license_plate VARCHAR, arrival_date TIMESTAMP, depart_date TIMESTAMP)
-- peid fid license_plate arrival_date description
RETURNS VOID AS $$
    DECLARE
        new_peid INT;
    BEGIN
        SELECT MAX(peid) INTO new_peid
        FROM permits;

        new_peid := new_peid + 1;

        INSERT INTO permits VALUES (new_peid, fid, license_plate, arrival_date);
        INSERT INTO shipyard_permits VALUES (new_peid, depart_date);

    END;
$$
LANGUAGE plpgsql;