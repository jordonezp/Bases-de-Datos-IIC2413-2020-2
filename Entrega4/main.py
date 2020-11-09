##### Importaciones
from flask import Flask, json
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
    messages = list(mensajes.find({}, {"_id": 0}))
    return json.jsonify(messages)

@app.route('/messages/<int:mid>')
def show_message(mid):
    messages = list(mensajes.find({"mid": mid}, {"_id": 0}))
    return json.jsonify(messages)

@app.route('/users')
def show_users():
    users = list(usuarios.find({}, {"_id": 0}))
    return json.jsonify(users)

@app.route('/users/<int:uid>')
def show_message(uid):
    users = list(usuarios.find({"uid": uid}, {"_id": 0}))
    return json.jsonify(users)


#### Rutas busqueda por texto


####### Rutas POST
####### Rutas DELETE




@app.route('/')
def hello_world():
    return 'Hello World!'

@app.route('/a')
def test():
    return "a"



if __name__ == '__main__':
    app.run()
