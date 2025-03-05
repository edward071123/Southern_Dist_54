CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    status ENUM('active', 'disabled') DEFAULT 'active', -- 公司狀態
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,  -- 產品所屬公司
    name VARCHAR(255) NOT NULL,
    name_en VARCHAR(255) NOT NULL,
    gtin CHAR(13) NOT NULL,  -- 限制 GTIN 為 13 個字元
    description TEXT NOT NULL,
    description_en TEXT NOT NULL,
    image VARCHAR(255) DEFAULT 'default.png',
    status ENUM('visible', 'hidden') DEFAULT 'visible',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    UNIQUE (gtin) -- 確保 GTIN 的唯一性
);


ALTER TABLE companies
ADD COLUMN address VARCHAR(255) NOT NULL AFTER name,
ADD COLUMN phone VARCHAR(20) NOT NULL AFTER address,
ADD COLUMN email VARCHAR(100) NOT NULL AFTER phone,
ADD COLUMN owner_name VARCHAR(100) NOT NULL AFTER email;


ALTER TABLE companies
ADD COLUMN is_exist INT AFTER status DEFAULT 1;