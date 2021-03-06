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
    # print('\n\n\n\n hola', mensajes.index_information())
    # mensajes.drop_indexes()
    # print('\n\n\n\n hola', mensajes.index_information())
    # mensajes.create_index([("message", TEXT)], default_language='none')

    # revisar que tenga cuerpo
    input_json = None
    try:
        input_json = request.json
    except:
        return show_messages()

    # print(input_json)

    if not input_json:
        return show_messages()

    # extraigo userId del json
    user_id = None
    if 'userId' in input_json:
        user_id = input_json['userId']
        del input_json['userId']

    # print('userId: ', user_id)
    # print(input_json)

    query = ''
    for key in input_json:
        if key == 'desired':
            for word in input_json[key]:
                query = query + '{} '.format(word)
        elif key == 'required':
            for word in input_json[key]:
                query = query + '\"{}\" '.format(word)
        elif key == 'forbidden':
            for word in input_json[key]:
                query = query + '-{} '.format(word)
        else:
            raise Exception('id curioso..')

    # probando lo de la issue...
    # cuando todos son forbidden
    print(input_json.keys())
    if list(input_json.keys()) == ['forbidden']:
        print('solamente negados...')
        forbidden_query = ''
        for word in input_json['forbidden']:
            forbidden_query = forbidden_query + '{} '.format(word)
        print('forbidden_query:', forbidden_query)
        if user_id:
            print('has userId:', user_id)
            all_messages = list(mensajes.find(
                {"sender": user_id}, {"_id": 0}))
            forbidden_messages = [m['mid'] for m in mensajes.find(
                {"$text": {"$search": forbidden_query}},
                {"_id": 0})]
            messages = [
                m for m in all_messages if m['mid'] not in forbidden_messages]
            return json.jsonify(messages)
        else:
            print('no userId')
            all_messages = list(mensajes.find({}, {"_id": 0}))
            forbidden_messages = [m['mid'] for m in mensajes.find(
                {"$text": {"$search": forbidden_query}},
                {"_id": 0})]
            messages = [
                m for m in all_messages if m['mid'] not in forbidden_messages]
            return json.jsonify(messages)

    empty_query = False
    if query == '':
        empty_query = True

    # si se indica userId
    if user_id:
        print('has userId:', user_id)
        if empty_query:
            print('query: empty')
            messages = list(mensajes.find(
                {"sender": user_id}, {"_id": 0}))
            return json.jsonify(messages)
        
        else:
            print('query:', query)
            messages = list(mensajes.find(
                {"sender": user_id, "$text": {"$search": query}},
                {"_id": 0}))
            return json.jsonify(messages)

    # si no se indica userID
    else:
        print('no userId')
        if empty_query:
            print('query: empty')
            return show_messages()
        else:
            print('query:', query)
            messages = list(mensajes.find(
                {"$text": {"$search": query}},
                {"_id": 0}))
            return json.jsonify(messages)

    return show_messages()
    # input = {}

    # try:
    #     input = request.json
    #     if input == {} or input == None:
    #         return show_messages()    

    # except:
    #     print("fail")
    #     return show_messages()  

    # print(input)

    
    # #si hay contenido, se comienza a armar la query
    # query = ''
    # user_key = False
    # #se construye la query a partir de lo que contengan los inputs
    # print(input.keys())
    # for new_key in input.keys():
    #     if new_key == "desired":
    #         for r in input["desired"]:
    #             print("entra desired")
    #             query = query + '{} '.format(r)
    #     elif new_key == "required":
    #         print("entra required")
    #         for r in input["required"]:
    #             query = query + '\"{}\" '.format(r)
    #     elif new_key == "forbidden":        
    #         for r in input["forbidden"]:
    #             query = query + f"-"+"{} ".format(r)
    #     else:
    #         print("entra else")
    #         query = query + ''
        
    #     if new_key == "userId":
    #         user_key=True


    # print("query:"+query)
    
    # #busqueda con filtro de usuario
    # if user_key:
    #     print("con usuario id:" + str(input["userId"]))
    #     print(type(query))
    #     if query == '':
    #         messages = list(mensajes.find({"sender": input["userId"]}, {"_id": 0}))
    #         return json.jsonify(messages)
    #     else:
    #         messages = list(mensajes.find(
    #         {"sender": input["userId"], "$text": {"$search": query}}, {"_id": 0}
    #         ))
    #         print(messages)
    #         return json.jsonify(messages)
        
    # #busqueda sin filtro de usuario
    # else:
    #     print("sin usuario")
    #     print(type(query))
    #     # messages = list(mensajes.find(
    #     #     {"$text": {"$search": query}}, {"_id": 0}
    #     # ))
    #     # return json.jsonify(messages)
    #     if query == '':
    #         messages = list(mensajes.find({"_id": 0}))
    #         return json.jsonify(messages)
    #     else:
    #         messages = list(mensajes.find(
    #         {"$text": {"$search": query}}, {"_id": 0}
    #         ))
    #         print(messages)
    #         return json.jsonify(messages)
    


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
            return json.jsonify({"success": False, "msg": f"KeyError: falta ingresar {key}"})
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

    mensajes.create_index([("message", TEXT)], default_language='none')
    # mensajes.create_index([
    #     {"message": "text"},
    #     {"default_language": "none"}])
    print(mensajes.index_information())
