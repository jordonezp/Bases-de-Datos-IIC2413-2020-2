import os
import pandas as pd

data_folder = "../data"


def read_data(data_folder):
    list_dir = os.listdir(data_folder)
    table_dict = {}
    for f in list_dir:
        path = os.path.join(data_folder, f)
        table_dict[f.strip(".csv")] = pd.read_csv(path)
    return table_dict


def read_employees(input_table):
    employees = input_table.rename(columns={
        'nombre': 'name',
        'rut': 'rut',
        'edad': 'age',
        'sexo': 'sex',
        'id_instalacion': 'fid'
    }, inplace=False)
    return employees


def read_ports(input_table):
    ports = input_table[["nombre_puerto"]]
    cities = input_table[["ciudad_puerto", "region_puerto"]]
    facilities = input_table[[
        "id_instalacion",
        "tipo_instalacion",
        "capacidad_instalacion",
        "rut_jefe"
    ]]
    facility_history_entry = input_table[[
        "id_instalacion",
        "tipo_instalacion",
        "capacidad_instalacion",
        "rut_jefe_cierre"
    ]]
    ports.drop_duplicates(inplace=True)
    cities.drop_duplicates(inplace=True)
    facilities.drop_duplicates(inplace=True)
    facility_history_entry.drop_duplicates(inplace=True)
    # ports.rename(
    #     columns={"nombre_puerto": "name"},
    #     inplace=True)
    # cities.rename(
    #     columns={"ciudad_puerto": "name", "region_puerto": "region"},
    #     inplace=True)
    # ports.index.name = "pid"
    # cities.index.name = "cid"
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
    return ships, shipyard_permits, dock_permits


# id_instalacion,nombre_barco,patente_barco,pais,fecha_atraque,fecha_salida,descripcion_actividad

if __name__ == "__main__":
    table_dict = read_data(data_folder)
    for t in table_dict:
        # print(table_dict[t])
        print(t)
    employees = read_employees(table_dict["personal_instalacion"])
    employees.to_csv("employees.csv", index=False)
    print(employees)
    ports, cities, facilities, facility_history_entry = read_ports(
        table_dict["puerto"])
    print(ports)
    print(cities)
    print(facilities)
    print(facility_history_entry)
    ships, shipyard_permits, dock_permits = read_permits(
        table_dict["permiso"])
    print(ships)
    print(shipyard_permits)
    print(dock_permits)
