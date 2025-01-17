<?php

declare(strict_types=1);

require_once 'src/interfaces/Displayable.php';
require_once 'src/classes/products/Product.php';
require_once 'src/classes/products/SmallProduct.php';
require_once 'src/classes/products/LargeProduct.php';
require_once 'src/classes/ShoppingBasket.php';
require_once 'src/classes/customers/Customer.php';
require_once 'src/classes/customers/BusinessCustomer.php';
require_once 'src/classes/EmailAddress.php';

$hat = new SmallProduct("Cowboy Hat", "A classic tan cowboy hat.", 15.79, false, 0.8);
$boots = new LargeProduct("Cowboy boots", "Black leather cowboy boots with spurs", 39.00, true, 4, 250, 30);
echo $hat->display();
echo $boots->display();
$boots->discountProduct();
echo $boots->display();
$email1 = new EmailAddress("bob@job.com");
$email2 = new EmailAddress("Bim@jim.com");
$customer1 = new Customer("Bob", "Job", "23 Here Street", "BS00 000", $email1);
$customer2 = new BusinessCustomer("Bim", "Fim", "23 There road", "BS11 111", $email2, "BimJim's Autos", "WhatIsAVATNumber?");
$newBasket1 = new ShoppingBasket($customer1);
$newBasket2 = new ShoppingBasket($customer2);
$newBasket1->addToBasket($hat);
$newBasket1->addToBasket($boots);
$newBasket1->addToBasket($boots);
$newBasket2->addToBasket($boots);
$newBasket2->addToBasket($hat);
echo "<br/>";
echo "***************";
echo $customer1->getAddress();
echo $newBasket1->display();
echo $newBasket1->getBasketTotal();
echo "<br/>";
echo $newBasket1->getShippingCostTotal();
echo "<br/>";
echo $newBasket1->getBasketPlusShippingTotal();
echo "<br/>";
echo "***************";
echo $customer2->getAddress();
echo $newBasket2->display();
echo $newBasket2->getBaskettotal();
echo "<br/>";
echo $newBasket2->getShippingCostTotal();
echo "<br/>";
echo $newBasket2->getBasketPlusShippingTotal();
echo "<br/>";
echo $newBasket2->getBasketPlusShippingTotal();