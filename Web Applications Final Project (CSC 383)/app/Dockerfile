FROM python:3.10-slim

WORKDIR /app

COPY . .


RUN pip install --no-cache-dir 'vanna[chromadb,openai,mysql]'
COPY main.py /app/main.py
# RUN pip install 'vanna[chromadb,openai,mysql]'

CMD ["python", "main.py"]
