CREATE DATABASE IF NOT EXISTS gerenciador_logistico CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gerenciador_logistico;

CREATE TABLE IF NOT EXISTS produtos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(120) NOT NULL,
 descricao TEXT,
 quantidade INT NOT NULL DEFAULT 1,
 peso DECIMAL(10,2) NOT NULL DEFAULT 0,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS enderecos (
 id INT AUTO_INCREMENT PRIMARY KEY,
 identificacao VARCHAR(100) NOT NULL,
 tipo ENUM('Origem','Destino','Ambos') NOT NULL DEFAULT 'Origem',
 rua VARCHAR(150) NOT NULL,
 numero VARCHAR(20),
 bairro VARCHAR(100),
 cidade VARCHAR(100) NOT NULL,
 uf CHAR(2),
 cep VARCHAR(10)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS transportadores (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(120) NOT NULL,
 documento VARCHAR(20),
 telefone VARCHAR(30),
 email VARCHAR(120),
 veiculo VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fretes (
 id INT AUTO_INCREMENT PRIMARY KEY,
 data_frete DATE NOT NULL,
 transportador_id INT NOT NULL,
 origem_id INT NOT NULL,
 destino_id INT NOT NULL,
 status VARCHAR(30) NOT NULL DEFAULT 'Pendente',
 observacao TEXT,
 criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_frete_transportador FOREIGN KEY (transportador_id) REFERENCES transportadores(id),
 CONSTRAINT fk_frete_origem FOREIGN KEY (origem_id) REFERENCES enderecos(id),
 CONSTRAINT fk_frete_destino FOREIGN KEY (destino_id) REFERENCES enderecos(id)
) ENGINE=InnoDB;

-- Tabela associativa: um frete pode conter vários produtos e um produto pode aparecer em vários fretes.
CREATE TABLE IF NOT EXISTS frete_produtos (
 frete_id INT NOT NULL,
 produto_id INT NOT NULL,
 PRIMARY KEY (frete_id, produto_id),
 CONSTRAINT fk_fp_frete FOREIGN KEY (frete_id) REFERENCES fretes(id) ON DELETE CASCADE,
 CONSTRAINT fk_fp_produto FOREIGN KEY (produto_id) REFERENCES produtos(id)
) ENGINE=InnoDB;
