\copy regions FROM 'regions.csv' DELIMITER ',' CSV HEADER;

\copy cities FROM 'cities.csv' DELIMITER ',' CSV HEADER;

\copy dock_permits FROM 'dock_permits.csv' DELIMITER ',' CSV HEADER;

\copy employees FROM 'employees.csv' DELIMITER ',' CSV HEADER;

\copy facilities FROM 'facilities.csv' DELIMITER ',' CSV HEADER;

\copy facility_history_entries FROM 'facility_history_entries.csv' DELIMITER ',' CSV HEADER;

\copy permits FROM 'permits.csv' DELIMITER ',' CSV HEADER;

\copy ports FROM 'ports.csv' DELIMITER ',' CSV HEADER;

\copy ships FROM 'ships.csv' DELIMITER ',' CSV HEADER;

\copy shipyard_permits FROM 'shipyard_permits.csv' DELIMITER ',' CSV HEADER;

-- COPY cities(cid, name, rid)
-- FROM 'cities.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY dock_permits(peid, description)
-- FROM 'dock_permits.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY employees(name, rut, age, sex, fid)
-- FROM 'employees.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY facilities(fid, type, capacity, boss_rut, pid)
-- FROM 'facilities.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY facility_history_entries(fheid, fid, closed_on, opened_on, close_boss_rut)
-- FROM 'facility_history_entries.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY permits(peid, fid, license_plate, arrival_date)
-- FROM 'permits.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY ports(pid, name, cid)
-- FROM 'ports.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY ships(name, license_plate, country)
-- FROM 'ships.csv'
-- DELIMITER ','
-- CSV HEADER;

-- COPY shipyard_permits(peid, depart_date)
-- FROM 'shipyard_permits.csv'
-- DELIMITER ','
-- CSV HEADER;
