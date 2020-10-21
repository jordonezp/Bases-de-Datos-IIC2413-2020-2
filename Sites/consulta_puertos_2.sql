CREATE OR REPLACE FUNCTION
get_facilities_by_port(pid int)
RETURNS TABLE (fid int, type varchar(100), capacity int, boss_rut varchar(50), pid2 int) AS $$
BEGIN
RETURN QUERY EXECUTE 'SELECT * FROM facilities WHERE facilities.pid = $1'USING pid;
RETURN;
END
$$
language plpgsql; 