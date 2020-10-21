CREATE OR REPLACE FUNCTION
filter_facilities_by_available_dates(t1 timestamp, t2 timestamp, pid int)
RETURNS TABLE (fid int, type varchar(100), capacity int, boss_rut varchar(50), pid2 int) AS $$
BEGIN
RETURN QUERY EXECUTE 'SELECT * FROM facilities WHERE facilities.pid = $1'USING pid;
RETURN;
END
$$
language plpgsql;