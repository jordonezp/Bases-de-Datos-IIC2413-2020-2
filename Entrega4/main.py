##### Importaciones
from flask import Flask, json, request
# import pandas
from pymongo import MongoClient, TEXT


##### Conexión con la BD
uri = "mongodb://grupo81:grupo81@gray.ing.puc.cl/grupo81?authSource=admin"
# La uri 'estándar' es "mongodb://user:password@ip/database"
client = MongoClient(uri)
db = client.get_database()


##### Declaración de la aplicación
app = Flask(__name__)


POST_MESSAGE_KEYS = [
    'message', 'sender', 'receptant', 'lat', 'long', 'date'
]
GET_TEXTSEARCH_KEYS = [
    'desired', 'required', 'forbidden', 'userId'
]

mensajes = db.mensajes
usuarios = db.usuarios


####### Rutas GET
#### Rutas básicas
@app.route('/messages')
def show_messages():
    if 'id1' in request.args and 'id2' in request.args:
        id1 = request.args.get('id1')
        id2 = request.args.get('id2')
        if id1.isdigit() and id2.isdigit():
            id1 = int(id1)
            id2 = int(id2)
            return show_messages_with_args(id1, id2)
    messages = list(mensajes.find({}, {"_id": 0}))
    return json.jsonify(messages)

def show_messages_with_args(id1, id2):
    # print(id1, id2)
    messages12 = list(mensajes.find(
        {"sender": id1, "receptant": id2}, {"_id": 0}))
    # print(messages12)
    messages21 = list(mensajes.find(
        {"sender": id2, "receptant": id1}, {"_id": 0}))
    # print(messages21)
    return json.jsonify(messages12 + messages21)

@app.route('/messages/<int:mid>')
def show_messages_by_id(mid):
    messages = list(mensajes.find({"mid": mid}, {"_id": 0}))
    return json.jsonify(messages)

@app.route('/users')
def show_users():
    users = list(usuarios.find({}, {"_id": 0}))
    return json.jsonify(users)

@app.route('/users/<int:uid>')
def show_messages_from_user(uid):
    users = list(usuarios.find({"uid": uid}, {"_id": 0}))
    messages = list(mensajes.find({"sender": uid}, {"_id": 0}))
    return json.jsonify(users + messages)



#### Rutas busqueda por texto
#busqueda sin body, no entra.

@app.route('/text-search')
def text_search():
    try:
        data = {key: request.json[key] for key in GET_TEXTSEARCH_KEYS}
    except(KeyError):
        return json.jsonify({"success": False, "msg": "KeyError, body incompleto"})
    except(TypeError):
        return json.jsonify({"success": False, "msg": "no tiene body"})

    print(data)
    query = ''
    for r in data["desired"]:
        query = query + ' {}'.format(r)
    for r in data["required"]:
        query = query + ' "{}"'.format(r)
    for r in data["forbidden"]:
        query = query + ' -"{}"'.format(r)

    print(query)
    if not data['userId']:
        messages = list(mensajes.find(
            {"$text": {"$search": query}}, {"_id": 0}
        ))
        return json.jsonify(messages)
    messages = list(mensajes.find(
        {"$text": {"$search": query}, "sender": data['userId']}, {"_id": 0}
    ))
    return json.jsonify(messages)


####### Rutas POST
# TODO: si falta el body, o no llega, 
# mensaje no debe ser insertado y notificar error
# TODO: el id del nuevo mensaje debe ser generado 
# de tal manera de que no coincida
@app.route('/messages', methods=['POST'])
def add_message():
    messages = list(mensajes.find({}, {"_id": 0}))
    max_mid = max(messages, key=lambda m: int(m['mid']))['mid']
    print(max_mid)
    print(request)
    for key in POST_MESSAGE_KEYS:
        try:
            data = {key: request.json[key] }
        except(KeyError):
            return json.jsonify({"success": False, "msg": f"KeyError: falta ingresar {key}, body incompleto"})
        except(TypeError):
            return json.jsonify({"success": False, "msg": "no tiene body"})
        data['mid'] = max_mid + 1
    print(data)
    result = mensajes.insert_one(data)
    print(result)
    return json.jsonify({"success": True})

####### Rutas DELETE
# error si no existe
@app.route('/message/<int:mid>', methods=['DELETE'])
def delete_message(mid):
    print(mid)
    messages = list(mensajes.find({"mid": mid}, {"_id": 0}))
    print(messages)
    if len(messages) != 1:
        if len(messages) < 1:
            return json.jsonify({"success": False, "msg": "Non existent mid."})
        else:
            return json.jsonify({"success": False, "msg": "Too many mids (there should be only 1)."})

    result = mensajes.remove({"mid": mid})
    print(result)
    return json.jsonify({"success": True})



@app.route('/')
def hello_world():
    return 'Hello World!'




if __name__ == '__main__':
    app.run()

    mensajes.create_index([("message", TEXT)])
