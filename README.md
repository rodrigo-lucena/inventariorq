Informações gerais
	
	InventarioRQ é uma aplicação web de gestão de reagentes de um ou mais laboratórios. Com ele é possível criar um banco de 	dados de reagentes químicos com informações relevantes de suas características e localizações, bem como fazer sua consulta. A aplicação pode ser utilizada em um único laboratório ou mesmo em um sistema de laboratórios, onde é possível preservar suas individualidades na alimentação do banco de dados e ao mesmo tempo permitir que a consulta de reagentes seja local ou global.
	As informações de uso da aplicação podem ser consultadas no arquivo /res/download/Tutorial.pdf
	No momento, a aplicação se encontra na versão 2.0. 


Instruções para instalação do InventarioRQ

	A aplicação está pronta para ser usada. Como ela foi personalizada para ser aplicada em uma determinada Universidade, a estética e informações do autor foram inseridas na aplicação para dar um caráter mais customizado e vinculá-la aos padrões da Universidade, mas essas características podem ser modificadas, porém por favor mantenha os créditos ao autor. Essas modificações serão realizadas essencialmente nos arquivos html.
	Já no arquivo /vendor/invent/php-classes/Config.php, foram adicionados métodos que retornam informações de configuração do banco de dados, do email de suporte e de chaves de criptografia. Todas essas informações devem ser configuradas pelo responsável em implantar o sistema em algum servidor.
	Todas as implementações do banco de dados se encontram no arquivo /Exportado20210802.sql. Basta importá-lo no banco de dados do servidor que todas as relações e seus atributos serão implementados no sistema.
	Mais informações da aplicação (na versão 1.0), podem ser encontradas no artigo publicado na revista Semana Acadêmica (https://semanaacademica.org.br/artigo/implementacao-de-uma-aplicacao-web-para-o-gerenciamento-de-produtos-quimicos-nos-laboratorios). De lá para cá, muitas correções e otimizações foram realizadas na aplicação, mas o artigo é um bom documento para compreender melhor esse projeto.

