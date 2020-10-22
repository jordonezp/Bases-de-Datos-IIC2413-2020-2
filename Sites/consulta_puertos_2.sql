CREATE OR REPLACE FUNCTION
generate_shipyard_permit(pid int)
RETURNS TABLE (fid int, type varchar(100), capacity int, boss_rut varchar(50), pid2 int) AS $$
BEGIN

/*  */
/* */
/* */
/* */

RETURN QUERY EXECUTE 'SELECT * FROM facilities WHERE facilities.pid = $1'USING pid;
RETURN;
END
$$
LANGUAGE plpgsql; 




/* */
/* */
/* */
/* */





CREATE OR REPLACE FUNCTION
generate_dock_permit(pid int)
RETURNS TABLE (fid int, type varchar(100), capacity int, boss_rut varchar(50), pid2 int) AS $$
BEGIN

/* */
/* */
/* */
/* */

RETURN QUERY EXECUTE 'SELECT * FROM facilities WHERE facilities.pid = $1'USING pid;
RETURN;
END
$$
LANGUAGE plpgsql; 