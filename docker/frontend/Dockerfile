FROM node:22.5

# instala um servidor http simples para servir conteúdo estático
RUN npm install -g http-server

# faz da pasta 'app' o diretório atual de trabalho
WORKDIR /app

# copia os arquivos 'package.json' e 'package-lock.json' (se disponível)
COPY ./frontend/package*.json ./

# Instalar dependências
RUN npm install

# Copiar arquivos do projeto
COPY ../../frontend .

# compila a aplicação de produção com minificação
RUN npm run build
