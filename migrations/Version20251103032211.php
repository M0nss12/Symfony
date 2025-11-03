<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251103032211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE camera (id SERIAL NOT NULL, model VARCHAR(255) NOT NULL, brand VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, megapixels INT NOT NULL, sensor_type VARCHAR(50) NOT NULL, wifi BOOLEAN NOT NULL, bluetooth BOOLEAN NOT NULL, description TEXT NOT NULL, stock_quantity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE customer (id SERIAL NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(100) NOT NULL, zip_code VARCHAR(10) NOT NULL, registration_date DATE NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "order" (id SERIAL NOT NULL, customer_id INT NOT NULL, camera_id INT NOT NULL, quantity INT NOT NULL, total_price NUMERIC(10, 2) NOT NULL, status VARCHAR(50) NOT NULL, order_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, payment_method VARCHAR(100) NOT NULL, shipping_address TEXT DEFAULT NULL, tracking_number VARCHAR(50) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON "order" (customer_id)');
        $this->addSql('CREATE INDEX IDX_F5299398B47685CD ON "order" (camera_id)');
        $this->addSql('CREATE TABLE review (id SERIAL NOT NULL, customer_id INT NOT NULL, camera_id INT NOT NULL, rating INT NOT NULL, comment TEXT NOT NULL, review_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, title VARCHAR(100) NOT NULL, is_verified_purchase BOOLEAN NOT NULL, image_quality_rating INT DEFAULT NULL, ease_of_use_rating INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C69395C3F3 ON review (customer_id)');
        $this->addSql('CREATE INDEX IDX_794381C6B47685CD ON review (camera_id)');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C69395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6B47685CD FOREIGN KEY (camera_id) REFERENCES camera (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398B47685CD');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C69395C3F3');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6B47685CD');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE review');
    }
}
