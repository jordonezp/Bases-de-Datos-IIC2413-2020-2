create table regions (
    rid int, 
    name varchar(100),
    primary key(rid)
);

CREATE TABLE cities (
    cid int, 
    name varchar(100), 
    rid int,
    primary key(cid),
    constraint fk_regions
        foreign key(rid)
            references regions(rid)
            on delete cascade
);


create table ships (
    license_plate varchar(50),
    name varchar(100),
    country varchar(100),
    primary key(license_plate)
);


create table permits (
    peid int, 
    fid int,
    license_plate varchar(50),
    arrival_date timestamp,
    primary key(peid),
    constraint fk_ships
        foreign key(license_plate)
            references ships(license_plate)
            on delete cascade
);

create table shipyard_permits (
    peid int, 
    depart_date timestamp, 
    primary key(peid),
    constraint fk_permits
        foreign key(peid)
            references permits(peid)
            on delete cascade
);

create table dock_permits (
    peid int references permits(peid), 
    description varchar(400),
    primary key(peid),
    constraint fk_permits
        foreign key(peid)
            references permits(peid)
            on delete cascade
);



create table ports (
    pid int,
    name varchar(100),
    cid int,
    primary key(pid),
    constraint fk_cities
        foreign key(cid)
            references cities(cid)
            on delete cascade
);

create table facilities (
    fid int,
    type varchar(100),
    capacity int,
    boss_rut varchar(50),
    pid int,
    primary key(fid),
    constraint fk_ports
        foreign key(pid)
            references ports(pid)
            on delete cascade
);


create table employees (
    rut varchar(50),
    name varchar(100),
    age int,
    sex varchar(50),
    fid int,
    primary key(rut),
    constraint fk_facilities
        foreign key(fid)
            references facilities(fid)
            on delete set null
);

alter table facilities 
    add constraint fk_boss
        foreign key(boss_rut)
            references employees(rut)
            on delete set null;

create table facility_history_entries (
    fheid int,
    closed_on timestamp,
    opened_on timestamp,
    fid int,
    close_boss_rut varchar(50),
    primary key(fheid),
    constraint fk_close_boss
        foreign key(close_boss_rut)
            references employees(rut)
            on delete cascade,
    constraint fk_facilities
        foreign key(fid)
            references facilities(fid)
            on delete cascade
);

create table docks (
    fid int,
    primary key(fid),
    constraint fk_facilities
        foreign key(fid)
            references facilities(fid)
            on delete cascade
);

create table shipyards (
    fid int,
    primary key(fid),
    constraint fk_facilities
        foreign key(fid)
            references facilities(fid)
            on delete cascade
);
