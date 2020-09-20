import os
import pandas as pd
import numpy as np

data_folder = "../data"


def read_data(data_folder):
    list_dir = os.listdir(data_folder)
    table_dict = {}
    for f in list_dir:
        path = os.path.join(data_folder, f)
        table_dict[f.strip(".csv")] = pd.read_csv(path)
    return table_dict


def read_employees(input_table):
    return input_table


def read_ports(input_table):
    ports = input_table[["nombre_puerto", "ciudad_puerto"]]
    cities = input_table[["ciudad_puerto", "region_puerto"]]
    facilities = input_table[[
        "id_instalacion",
        "tipo_instalacion",
        "capacidad_instalacion",
        "rut_jefe",
        "nombre_puerto",
        "ciudad_puerto"
    ]]
    facility_history_entry = input_table[[
        "id_instalacion",
        "fecha_cierre",
        "fecha_apertura",
        "rut_jefe_cierre"
    ]]

    ports.drop_duplicates(inplace=True)
    ports.insert(0, 'pid', range(0, 0 + len(ports)))
    ports.insert(2, 'cid', 0)
    cities.insert(0, 'cid', range(0, 0 + len(cities)))
    facilities.insert(5, 'pid', 0)

    for index, p in ports.iterrows():
        ports.loc[index, 'cid'] = cities.loc[index, 'cid']

    for index_f, f in facilities.iterrows():
        for index_p, p in ports.iterrows():
            if (p.nombre_puerto == f.nombre_puerto and
                    p.ciudad_puerto == f.ciudad_puerto):
                facilities.loc[index_f, 'pid'] = ports.loc[index_p, 'pid']

    ports = ports[["pid", "nombre_puerto", "cid"]]

    ports.drop_duplicates(inplace=True)
    cities.drop_duplicates(inplace=True)
    facilities.drop_duplicates(inplace=True)
    facility_history_entry.drop_duplicates(inplace=True)
    facility_history_entry.insert(
        0, 'fheid', range(0, 0 + len(facility_history_entry)))

    return ports, cities, facilities, facility_history_entry


def read_permits(input_table):
    ships = input_table[["nombre_barco", "patente_barco", "pais"]]
    shipyard_permits = input_table[[
        "id_instalacion", "patente_barco", "fecha_atraque", "fecha_salida"]]
    dock_permits = input_table[[
        "id_instalacion", "patente_barco", "fecha_atraque",
        "descripcion_actividad"]]
    ships.drop_duplicates(inplace=True)
    shipyard_permits.drop_duplicates(inplace=True)
    dock_permits.drop_duplicates(inplace=True)
    shipyard_permits = shipyard_permits[
        shipyard_permits["fecha_salida"].notnull()]
    dock_permits = dock_permits[
        dock_permits["descripcion_actividad"].notnull()]

    shipyard_permits.insert(0, 'spid', range(0, 0 + len(shipyard_permits)))
    dock_permits.insert(0, 'dpid', range(0, 0 + len(dock_permits)))

    return ships, shipyard_permits, dock_permits


# id_instalacion,nombre_barco,patente_barco,pais,fecha_atraque,fecha_salida,descripcion_actividad

if __name__ == "__main__":
    table_dict = read_data(data_folder)
    for t in table_dict:
        # print(table_dict[t])
        print(t)
    employees = read_employees(table_dict["personal_instalacion"])
    ports, cities, facilities, facility_history_entry = read_ports(
        table_dict["puerto"])
    ships, shipyard_permits, dock_permits = read_permits(
        table_dict["permiso"])
    print(employees)
    print(ports)
    print(cities)
    print(facilities)
    print(facility_history_entry)
    print(ships)
    print(shipyard_permits)
    print(dock_permits)

    employees.rename(columns={
        'nombre': 'name',
        'rut': 'rut',
        'edad': 'age',
        'sexo': 'sex',
        'id_instalacion': 'fid'
    }, inplace=True)
    ports.rename(columns={
        'pid': 'pid',
        'nombre_puerto': 'name',
        'cid': 'cid',
    }, inplace=True)
    cities.rename(columns={
        'cid': 'cid',
        'ciudad_puerto': 'name',
        'region_puerto': 'region',
    }, inplace=True)
    facilities.rename(columns={
        'id_instalacion': 'fid',
        'tipo_instalacion': 'type',
        'capacidad_instalacion': 'capacity',
        'rut_jefe': 'boss_rut',
        'pid': 'pid',
    }, inplace=True)
    facility_history_entry.rename(columns={
        'fheid': 'fheid',
        'id_instalacion': 'fid',
        'fecha_cierre': 'closed_on',
        'fecha_apertura': 'opened_on',
        'rut_jefe_cierre': 'close_boss_rut',
    }, inplace=True)
    ships.rename(columns={
        'patente_barco': 'license_plate',
        'nombre_barco': 'name',
        'pais': 'country',
    }, inplace=True)
    shipyard_permits.rename(columns={
        'spid': 'spid',
        'id_instalacion': 'fid',
        'patente_barco': 'license_plate',
        'fecha_atraque': 'arrival_date',
        'fecha_salida': 'depart_date',
    }, inplace=True)
    dock_permits.rename(columns={
        'dpid': 'dpid',
        'id_instalacion': 'fid',
        'patente_barco': 'license_plate',
        'fecha_atraque': 'arrival_date',
        'descripcion_actividad': 'description',
    }, inplace=True)

    for index, e in employees.iterrows():
        if e.sex == 'hombre':
            employees.loc[index, 'sex'] = 'male'
        elif e.sex == 'mujer':
            employees.loc[index, 'sex'] = 'female'
        else:
            employees.loc[index, 'sex'] = ''
    for index, f in facilities.iterrows():
        if f.type == 'astillero':
            facilities.loc[index, 'type'] = 'shipyard'
        elif f.type == 'muelle':
            facilities.loc[index, 'type'] = 'dock'
        else:
            facilities.loc[index, 'type'] = ''

    employees.to_csv("employees.csv", index=False)
    ports.to_csv("ports.csv", index=False)
    cities.to_csv("cities.csv", index=False)
    facilities.to_csv("facilities.csv", index=False)
    facility_history_entry.to_csv("facility_history_entry.csv", index=False)
    ships.to_csv("ships.csv", index=False)
    shipyard_permits.to_csv("shipyard_permits.csv", index=False)
    dock_permits.to_csv("dock_permits.csv", index=False)
