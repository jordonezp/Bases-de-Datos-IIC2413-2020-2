##### Importaciones
from flask import Flask, json, request
# import pandas
from pymongo import MongoClient


##### Conexión con la BD
uri = "mongodb://grupo81:grupo81@gray.ing.puc.cl/grupo81?authSource=admin"
# La uri 'estándar' es "mongodb://user:password@ip/database"
client = MongoClient(uri)
db = client.get_database()


##### Declaración de la aplicación
app = Flask(__name__)


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


####### Rutas POST
@app.route('/users', methods=['POST'])
def add_message():
    pass

####### Rutas DELETE




@app.route('/')
def hello_world():
    return 'Hello World!'




if __name__ == '__main__':
    app.run()
