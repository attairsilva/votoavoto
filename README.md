## 🚀 VOTO A VOTO

Este pequeno sisteminha web foi desenvolvido em 2018 para atender à necessidade pontual de um Conselho de Classe Profissional para agilizar o processo de recebimento e confirmação de envelopes contendo cédulas de votação.

É importante ressaltar que o sistema não é utilizado para a contagem de votos, mas sim para certificar o recebimento de um envelope eleitoral. Ele é apenas um dos passos de um macroprocesso.

Antes de sua operação, é necessário inserir no sistema uma lista de registros. Trata-se de uma planilha CSV e deve conter colunas ordenadas da seguinte forma: Número de Inscrição, Nome, Logradouro, Número do Logradouro, Complemento do Logradouro, Bairro do Logradouro, Município, Estado e CEP. É fundamental atentar para situações como exitência de caracteres especiais e registros duplicados na lista de profissionais, pois a duplicação podem caucar problemas durante a leitura.

Utilizando esta mesma relação, é preciso gerar um código de barras utilizando o campo 'numero de inscrição' desta planilha. Este código de barras é encaminhado ao eleitor em etapas que antecedem a apuração,fixado em envelope pardo sem identificação.

Antes da sessão de recebimento e abertura dos envelopes e contagem dos votos, o mesmos passa pelo leitor do sistema. Com o uso de uma pistola leitora de codigo de barras, é realizada a conferencia se o codigo encontra-se no banco de dados e registra automaticamente como verdadeiro. 

O perfil administrador é o único habilitado para inserir a relação, emitir relatórios, cadastrar usuários e etc.

O sistema também trás uma funcionalidade no ambiente administrador referente ao Computo Geral de Votos. É uma sessão para auxiliar a apuração manual de votos, onde é possível lançamento da apuração para obtenção de um documento ATA em formato ',DOC'. É necessário configurar o ambiente antes de sua utilização, cadastrando a Comissão, Chapas, Candidatos e etc.

Esperamos que este sistema contribua para facilitar os procedimentos do trabalho que se pretende realizar.

## 🚀 Guia de Instalação do Projeto

Siga este guia para instalar e executar o projeto em sua máquina.

### ⚙️ Pré-requisitos

1. **Docker:**
    - Verifique se o Docker está instalado em seu Windows executando os seguintes comandos no PowerShell:
      ```powershell
      docker --version
      docker-compose --version
      ```
    - Se o Docker não estiver instalado, baixe e instale o **Docker Desktop**.

2. **WSL 2 (Windows 10/11):**
    - Habilite o WSL 2, essencial para o Docker Desktop. Se não estiver instalado, execute o seguinte comando no PowerShell:
      ```powershell
      wsl --install
      ```
    - Em seguida, execute:
      ```powershell
      Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Windows-Subsystem-Linux
      ```

### 🐳 Executando o Projeto com Docker

1. **Navegue até o diretório raiz do projeto:** `C:\caminho do projeto` no PowerShell.

1. **Criar a pasta mysql_data dentro da pasta raiz:** `C:\caminho do projeto` 

    ```powershell
     mkdir mysql_data

Este será o local onde serão criados os arquivos do banco de dados padrão.


2. **Execute o comando:**
   ```powershell
   docker-compose up --build --force-recreate

### :computer: Acessando o sistema

1. **Localhost:** 

Host: http://localhost:8080/votoavoto
Login: admin
Senha: admin

2. **PhpMyAdmin:** 

Host: http://localhost:8081/votoavot

### 🐳 Gerenciando o Docker

1. **Visualizar containers em execução:** 
    ```powershelL
    docker ps

2. **Ver logs do container:** 
    ```powershelL 
    docker-compose logs

    
2. **Executar em segundo plano:** 
    ```powershelL 
    docker-compose up -d


2. **Resetar volumes:** 
    ```powershelL 
    docker-compose down -v


2. **Encerrar o container:** 
    ```powershelL 
    docker-compose down