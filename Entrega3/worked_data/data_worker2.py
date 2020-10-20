import os
import pandas as pd
import numpy as np

data_folder = "../data"


def read_data(data_folder):
    list_dir = os.listdir(data_folder)
    table_dict = {}
    for f in list_dir:
        path = os.path.join(data_folder, f)
        table_dict[f.replace(".csv", "")] = pd.read_csv(path)
    return table_dict


def combine_permits(shipyard_permits, dock_permits):
    # print(shipyard_permits)
    # print(dock_permits)
    # print()
    new_permits_data = []
    new_shipyard_permits_data = []
    new_dock_permits_data = []
    i = 1
    for sp in shipyard_permits.values:
        p_data = sp[1:4]
        sp_data = sp[4:5]
        new_permits_data.append(np.append(i, p_data))
        new_shipyard_permits_data.append(np.append(i, sp_data))
        i += 1
    for dp in dock_permits.values:
        p_data = dp[1:4]
        dp_data = dp[4:5]
        new_permits_data.append(np.append(i, p_data))
        new_dock_permits_data.append(np.append(i, dp_data))
        i += 1

    new_permits = pd.DataFrame(
        data=new_permits_data, columns=[
            'peid', 'fid', 'license_plate', 'arrival_date'])
    new_shipyard_permits = pd.DataFrame(
        data=new_shipyard_permits_data, columns=['peid', 'depart_date'])
    new_dock_permits = pd.DataFrame(
        data=new_dock_permits_data, columns=['peid', 'description'])

    return new_permits, new_shipyard_permits, new_dock_permits


def extract_regions(cities, ports):
    # print(cities)

    new_regions = cities[['region']]
    new_regions.rename(columns={
        'region': 'name'
    }, inplace=True)
    new_regions.drop_duplicates(inplace=True)
    new_regions.insert(0, 'rid', range(0, 0 + len(new_regions)))

    new_cities_data = []
    new_regions_data = []

    for c in cities.values:
        c_data = c[0:2]
        region_name = c[2]
        rid = None
        for r in new_regions.values:
            if (r[1] == region_name):
                rid = r[0]
        new_cities_data.append(np.append(c_data, rid))

    new_cities = pd.DataFrame(
        data=new_cities_data, columns=['cid', 'name', 'rid'])

    new_cities_2 = new_cities.copy()

    new_cities_2.drop_duplicates(
        subset=['name', 'rid'], keep='first', inplace=True)

    new_ports_data = []

    for p in ports.values:
        # print(p)
        cid = p[2]
        found = False
        for c in new_cities_2.values:
            if c[0] == cid:
                found = True
                new_ports_data.append(p)
                break
        for c in new_cities.values:
            if c[0] == cid:
                found = True
                for c2 in new_cities_2.values:
                    if str(c2[1:3]) == str(c[1:3]):
                        print('to handle:', c2[1:3])
                        new_p = p
                        new_p[2] = c2[0]
                        new_ports_data.append(new_p)
                        break
                break
        if not found:
            raise Exception('algo anda mal...')

    # print(new_cities_2)

    new_ports = pd.DataFrame(
        data=new_ports_data, columns=['pid', 'name', 'cid'])

    return new_cities, new_regions, new_ports


if __name__ == "__main__":
    table_dict = read_data(data_folder)
    for t in table_dict:
        # print(table_dict[t])
        print(t)

    permits, shipyard_permits, dock_permits = combine_permits(
        table_dict['shipyard_permits'],
        table_dict['dock_permits']
    )
    print(permits)
    print(shipyard_permits)
    print(dock_permits)

    cities, regions, ports = extract_regions(
        table_dict['cities'],
        table_dict['ports']
    )
    print(cities)
    print(regions)
    print(ports)

    dock_permits.to_csv('dock_permits.csv', index=False)
    shipyard_permits.to_csv('shipyard_permits.csv', index=False)
    permits.to_csv('permits.csv', index=False)
    cities.to_csv('cities.csv', index=False)
    regions.to_csv('regions.csv', index=False)
    ports.to_csv('ports.csv', index=False)
