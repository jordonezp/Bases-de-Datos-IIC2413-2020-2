-- \copy regions FROM 'regions.csv' DELIMITER ',' CSV HEADER;

-- \copy cities FROM 'cities.csv' DELIMITER ',' CSV HEADER;

-- \copy dock_permits(peid,description) FROM 'dock_permits.csv' DELIMITER ',' CSV HEADER;

-- \copy employees(name,rut,age,sex,fid) FROM 'employees.csv' DELIMITER ',' CSV HEADER;

-- \copy facilities(fid,capacity,boss_rut,pid) FROM 'facilities.csv' DELIMITER ',' CSV HEADER;

-- \copy facility_history_entries(fheid,fid,closed_on,opened_on,close_boss_rut) FROM 'facility_history_entries.csv' DELIMITER ',' CSV HEADER;

-- \copy permits(peid,fid,license_plate,arrival_date) FROM 'permits.csv' DELIMITER ',' CSV HEADER;

-- \copy ports FROM 'ports.csv' DELIMITER ',' CSV HEADER;

-- \copy ships(name,license_plate,country) FROM 'ships.csv' DELIMITER ',' CSV HEADER;

-- \copy shipyard_permits(peid,depart_date) FROM 'shipyard_permits.csv' DELIMITER ',' CSV HEADER;

-- \copy facilities(fid,capacity,boss_rut,pid) FROM 'facilities.csv' DELIMITER ',' CSV HEADER;

-- \copy shipyards(fid) FROM 'shipyards.csv' DELIMITER ',' CSV HEADER;

-- \copy docks(fid) FROM 'docks.csv' DELIMITER ',' CSV HEADER;
