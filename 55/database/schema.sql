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
