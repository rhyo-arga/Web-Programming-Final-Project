-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 05:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminId` varchar(4) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(13) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `HireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminId`, `Name`, `Address`, `ContactNumber`, `Email`, `Password`, `HireDate`) VALUES
('A001', 'Audrey', 'new york', '0812345678', 'audreyrospa@gmail.com', '339dc8551b342386146011ed2239c9a6', '2021-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookId` int(11) NOT NULL,
  `CategoryId` varchar(4) NOT NULL,
  `PublisherId` varchar(4) NOT NULL,
  `Isbn` varchar(13) NOT NULL,
  `BookTitle` varchar(100) NOT NULL,
  `Author` varchar(40) DEFAULT NULL,
  `Stock` int(11) DEFAULT 0,
  `Image` varchar(300) NOT NULL DEFAULT 'photo/book/default_book.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookId`, `CategoryId`, `PublisherId`, `Isbn`, `BookTitle`, `Author`, `Stock`, `Image`) VALUES
(1, 'CArD', 'P001', '9781982112912', 'David Copperfield\'s History of Magic', 'David Copperfield', 3, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982112912/david-copperfields-history-of-magic-9781982112912_lg.jpg'),
(2, 'CArD', 'P001', '9781982152116', 'The Art of Bob Mackie', 'Frank Vlastnik', 7, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982152116/the-art-of-bob-mackie-9781982152116_lg.jpg'),
(3, 'CArD', 'P001', '9781621537915', 'The Joy of Art', 'Carolyn Schlam', 6, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781621537915/the-joy-of-art-9781621537915_lg.jpg'),
(4, 'CEcn', 'P001', '9781982154813', 'Your Next Five Moves', 'Patrick Bet-David', 9, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982154813/your-next-five-moves-9781982154813_lg.jpg'),
(5, 'CFic', 'P001', '9781982154875', 'Game On\r\nTempting Twenty-Eight', 'Janet Evanovich', 10, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982154875/game-on-9781982154875_lg.jpg'),
(6, 'CFic', 'P001', '9781982154844', 'Fortune and Glory\r\nTantalizing Twenty-Seven', 'Janet Evanovich', 3, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982154844/fortune-and-glory-9781982154844_lg.jpg'),
(7, 'CFic', 'P001', '9781982104412', 'Forgiving Paris', 'Karen Kingsbury', 2, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982104412/forgiving-paris-9781982104412_lg.jpg'),
(8, 'CHis', 'P001', '9781982176525', 'Countdown bin Laden The Untold Story of the 247-Day Hunt to Bring the Mastermind of 9/11 to Justice', 'Chris Wallace', 23, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982176525/countdown-bin-laden-9781982176525_lg.jpg'),
(9, 'CSci', 'P001', '9781982115852', 'The Code Breaker Jennifer Doudna, Gene Editing, and the Future of the Human Race', 'Walter Isaacson', 0, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982115852/the-code-breaker-9781982115852_lg.jpg'),
(10, 'CSci', 'P001', '9781982113483', 'Every Tool\'s a Hammer', 'Adam Savage', 2, 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781982113483/every-tools-a-hammer-9781982113483_lg.jpg'),
(11, 'CEcn', 'P002', '9780593332214', 'The First Tycoon\r\nTHE EPIC LIFE OF CORNELIUS VANDERBILT', 'SCOTT GALLOWAY', 3, 'https://images1.penguinrandomhouse.com/cover/9780593332214'),
(12, 'CFic', 'P002', '9780593320426', 'Murakami T\r\nTHE T-SHIRTS I LOVE', 'HARUKI MURAKAMI', 1, 'https://images1.penguinrandomhouse.com/cover/9780593320426'),
(14, 'CHis', 'P002', '9780307279286', 'Say Nothing\r\nA TRUE STORY OF MURDER AND MEMORY IN NORTHERN IRELAND', 'PATRICK RADDEN KEEFE', 6, 'https://images1.penguinrandomhouse.com/cover/9780307279286'),
(15, 'CSci', 'P002', '9781101974322', 'Eat Like a Fish', 'BREN SMITH', 5, 'https://images4.penguinrandomhouse.com/cover/9781101974322'),
(16, 'CTec', 'P002', '9780525431992', 'Bad Blood', 'JOHN CARREYROU', 1, 'https://images2.penguinrandomhouse.com/cover/9780525431992'),
(17, 'CTec', 'P002', '9781984877734', 'Tools and Weapons', 'BRAD SMITH and CAROL ANN BROWNE', 2, 'https://images3.penguinrandomhouse.com/cover/9781984877734'),
(18, 'CFic', 'P003', '9780062060624', 'The Song of Achilles', ' Madeline Miller', 8, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9780062060624.jpg?v=1637425012'),
(19, 'CFic', 'P003', '9780062797155', 'The Tattooist of Auschwitz', ' Heather Morris', 4, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9780062797155_c815ad0e-eb1d-4daf-97c4-d60773790019.jpg?v=1637413470'),
(20, 'CArD', 'P003', '9780062270290', 'The Artisan Soul', ' Erwin Raphael McManus', 9, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9780062270290.jpg?v=1637437619'),
(21, 'CHis', 'P003', '9781335983763', 'Truth: A Brief History of Total Bullsh*t', 'Tom Phillips', 2, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9781335983763.jpg?v=1637445370'),
(22, 'CHis', 'P003', '9780063045989', 'Hillbilly Elegy', ' J. D. Vance', 1, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9780063045989_0e2ae755-083b-4554-990d-2a4c082bc204.jpg?v=1637429826'),
(23, 'CTec', 'P003', '9780062651235', 'Blood, Sweat, and Pixels', 'Jason Schreier', 0, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9780062651235_235b1a26-6b1d-4360-8703-2b90d5cbfcef.jpg?v=1637444069'),
(24, 'CTec', 'P003', '9780061709692', 'What Would Google Do?', 'Jeff Jarvis', 1, 'https://cdn.shopify.com/s/files/1/0285/2821/4050/products/9780061709692.jpg?v=1637431244'),
(25, 'CFic', 'P004', '9780765398338', 'Red', 'Ramsey Shehadeh', 2, 'https://mpd-biblio-covers.imgix.net/9780765398338.jpg?w=900'),
(26, 'CFic', 'P004', '9780374100230', '40', 'Alan Heathcock', 3, 'https://mpd-biblio-covers.imgix.net/9780374100230.jpg?w=900'),
(27, 'CArD', 'P004', '9780312538576', 'Joy The Happiness That Comes from Within', 'Osho', 0, 'https://mpd-biblio-covers.imgix.net/9780312538576.jpg?w=900'),
(28, 'CFic', 'P005', '9786020655390', 'Saat-Saat Tersiksa', 'John Connolly', 10, 'https://gpu.id/data-gpu/images/img-book/93562/621185010.jpg'),
(29, 'CEcn', 'P005', '9786020656588', 'Membangun Ketangguhan Ekonomi Era Pandemi', 'Riznaldi Akbar, Rita Helbra T, Maxensius', 7, 'https://gpu.id/data-gpu/images/img-book/93578/621203023.jpg'),
(30, 'CArD', 'P005', '9789792220636', 'MetroPop Klasik: Perang Bintang', 'Dewie Sekar', 6, 'https://gpu.id/data-gpu/images/uploads/book/68611cbe115055dff16caeae2787e294.jpg'),
(37, 'CFic', 'P004', '98537300271', 'Harry Potter', 'J. K. Rowling', 10, 'photo/book/d02d79668bee0dc708018b2f93c85bc8.png'),
(38, 'CNoF', 'P005', '974620183764', 'How To Write Non-Fiction', 'Joanna Penn', 5, 'photo/book/5871800c46dd646c16224a52ab558499.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryId` varchar(4) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryId`, `CategoryName`, `Description`) VALUES
('CArD', 'Art & Design', 'All about art & Designing'),
('CEcn', 'Economic', 'This Category is all about economy and finance.'),
('CFic', 'Fiction Novel', 'This Category is full of fiction novel from the greatest writer'),
('CHis', 'History', 'History arround the world'),
('CNoF', 'Non Fiction Novel', 'Lorem Ipsum'),
('CSci', 'Science', 'This Category full of science book'),
('CTec', 'Technology', 'All about technology in this category');

-- --------------------------------------------------------

--
-- Table structure for table `inputs`
--

CREATE TABLE `inputs` (
  `AdminId` varchar(4) DEFAULT NULL,
  `BookId` int(11) DEFAULT NULL,
  `InputDate` date DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inputs`
--

INSERT INTO `inputs` (`AdminId`, `BookId`, `InputDate`, `Quantity`) VALUES
('A001', 37, '0000-00-00', 10),
('A001', 38, '0000-00-00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Nim` varchar(9) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(13) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Image` varchar(100) NOT NULL DEFAULT 'photo/user/default.svg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Nim`, `Name`, `Address`, `ContactNumber`, `Email`, `Password`, `Image`) VALUES
('123200059', 'Rhyo Argasiwi', 'Yogyakarta', '081234567890', 'rhyoargasiwi23@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'photo/user/default.svg'),
('123200172', 'Audrey', 'new york', '0812345678', 'audreyrospa@gmail.com', 'audreyrospa', 'https://ntvb.tmsimg.com/assets/assets/965881_v9_bb.jpg?w=270&h=360');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `PublisherId` varchar(4) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(80) DEFAULT NULL,
  `ContactNumber` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`PublisherId`, `Name`, `Address`, `ContactNumber`) VALUES
('P001', 'Simon & Schuster', 'Simon & Schuster Building, Manhattan, New York City, U.S.', '212-698-7033'),
('P002', 'Penguin Random House', 'Random House Tower,\r\nNew York City, United States', '212-366-2636'),
('P003', 'Harper Collins', 'HarperCollins Publishers\r\n195 Broadway\r\nNew York, NY 10007', '212-207-7000'),
('P004', 'Macmillan', 'Equitable Building New York City, United States', '646-600-7856'),
('P005', 'Kompas Gramedia', 'South Palmerah road 22-26, Jakarta, Indonesia', '021-53650110'),
('P006', 'Mizan', 'Jl. Cinambo No.135, Cisaranten Wetan, Cinambo, Kota Bandung, Jawa Barat 40293', '0227834310');

-- --------------------------------------------------------

--
-- Table structure for table `returnings`
--

CREATE TABLE `returnings` (
  `ReturningId` int(11) NOT NULL,
  `TransactionId` int(11) NOT NULL,
  `MemberReturningDate` date DEFAULT NULL,
  `DeterminedReturningDate` date DEFAULT NULL,
  `Fine` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returnings`
--

INSERT INTO `returnings` (`ReturningId`, `TransactionId`, `MemberReturningDate`, `DeterminedReturningDate`, `Fine`) VALUES
(20, 29, '0000-00-00', '2021-12-16', 94883428),
(21, 30, '0000-00-00', '2021-12-16', 94883428);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionId` int(11) NOT NULL,
  `BookId` int(11) NOT NULL,
  `Nim` varchar(9) NOT NULL,
  `BorrowingDate` date NOT NULL,
  `Status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionId`, `BookId`, `Nim`, `BorrowingDate`, `Status`) VALUES
(29, 16, '123200059', '2021-12-09', 'returned'),
(30, 38, '123200059', '2021-12-09', 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `BookId` int(11) DEFAULT NULL,
  `Nim` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`BookId`, `Nim`) VALUES
(2, '123200059');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookId`),
  ADD KEY `fk_c_id` (`CategoryId`),
  ADD KEY `fk_p_id` (`PublisherId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `inputs`
--
ALTER TABLE `inputs`
  ADD KEY `fk_admin_id` (`AdminId`),
  ADD KEY `fk_books_id` (`BookId`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Nim`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`PublisherId`);

--
-- Indexes for table `returnings`
--
ALTER TABLE `returnings`
  ADD PRIMARY KEY (`ReturningId`),
  ADD KEY `fk_t_id` (`TransactionId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionId`),
  ADD KEY `fk_m_id` (`Nim`),
  ADD KEY `fk_b_id` (`BookId`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD KEY `fk_book_id` (`BookId`),
  ADD KEY `fk_member_id` (`Nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `returnings`
--
ALTER TABLE `returnings`
  MODIFY `ReturningId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_c_id` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`CategoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`PublisherId`) REFERENCES `publishers` (`PublisherId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inputs`
--
ALTER TABLE `inputs`
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`AdminId`) REFERENCES `admins` (`AdminId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_books_id` FOREIGN KEY (`BookId`) REFERENCES `books` (`BookId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returnings`
--
ALTER TABLE `returnings`
  ADD CONSTRAINT `fk_t_id` FOREIGN KEY (`TransactionId`) REFERENCES `transactions` (`TransactionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_b_id` FOREIGN KEY (`BookId`) REFERENCES `books` (`BookId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_m_id` FOREIGN KEY (`Nim`) REFERENCES `members` (`Nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`BookId`) REFERENCES `books` (`BookId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`Nim`) REFERENCES `members` (`Nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
