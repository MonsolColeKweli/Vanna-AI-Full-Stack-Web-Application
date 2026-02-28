from vanna.openai import OpenAI_Chat
from vanna.chromadb import ChromaDB_VectorStore
from vanna.flask import VannaFlaskApp
import os

class MyVanna(ChromaDB_VectorStore, OpenAI_Chat):
    def __init__(self, config=None):
        ChromaDB_VectorStore.__init__(self, config=config)
        OpenAI_Chat.__init__(self, config=config)

config = {
    'api_key': os.getenv('OPENAI_API_KEY'),
    'model': os.getenv('OPENAI_MODEL')
}

vn = MyVanna(config=config)

vn.connect_to_mysql(
    host=os.getenv('MYSQL_HOST'),
    dbname=os.getenv('MYSQL_DB'),
    user=os.getenv('MYSQL_USER'),
    password=os.getenv('MYSQL_PASSWORD'),
    port=int(os.getenv('MYSQL_PORT'))
)

ddl_path = "/app/ddl/schema.sql"
if os.path.exists(ddl_path):
    with open(ddl_path, 'r') as f:
        ddl = f.read()
        vn.train(ddl=ddl)

app = VannaFlaskApp(vn)
app.run(host="0.0.0.0", port=5000)

