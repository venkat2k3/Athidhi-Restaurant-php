<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = [];
    }

    function AddtoOrder($itemName, $itemPrice) {
        $_SESSION['orders'][] = [
            'name' => $itemName,
            'price' => (float) $itemPrice
        ];
    }

    if (isset($_POST['item_name'], $_POST['item_price'])) {
        AddtoOrder($_POST['item_name'], $_POST['item_price']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Biryani</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <div class="fulldiv">
    <button class="back-btn" onclick="window.history.back()" style='font-size:20px;'>&#8617;</button>
    <button class="forw-right" onclick="window.location.href='Orders.php';" style='font-size:20px;'>&#8618;</button>

        
        <div class="box1">
            <img src="public\images\pulka 1.jpg" alt="Biryani" />
            <div class="content1">
                <h3 name="item-name">Fried Chicken-Biryani</h3>
                <p>only in two lones
                Savor our Fried Chicken Biryani, where crispy, marinated chicken meets fragrant, spiced basmati rice, creating a harmonious explosion of flavors. </p>
                <button class="btn1" onclick="addToOrder('Fried Chicken-Biryani', 249)">ADD</button>
            </div>
        </div><br/><br/>

        <div class="box2">
            <img src="public\images\Butter Naan 1.jpg" alt="Biryani" />
            <div class="content2">
                <h3>Mutton Biryani</h3>
                <p>Delight in our Mutton Biryani, where tender mutton pieces are perfectly cooked with fragrant, spiced basmati rice. Each mouthful promises a rich blend of flavors that will leave you craving for more. </p>
                <button class="btn2" onclick="addToOrder('Mutton Biryani', 269)">ADD</button>
            </div>
        </div><br/><br/>

        <div class="box1">
            <img src="public\images\Butter roti 1.jpg" alt="Biryani" />
            <div class="content1">
                <h3>Paneer Biryani</h3>
                <p>Savor the richness of our Paneer Biryani, where soft, marinated paneer cubes are perfectly cooked with aromatic, spiced basmati rice.</p>
                <button class="btn1" onclick="addToOrder('Paneer Biryani', 199)">ADD</button>
            </div>
        </div><br/><br/>
        <div class="box2">
            <img src="public\images\Tandooriu roti 1.jpg" alt="Biryani" />
            <div class="content2">
                <h3>Egg Biryani</h3>
                <p >Indulge in our Egg Biryani, where perfectly boiled eggs are nestled among layers of fragrant, spiced basmati rice. </p>
                <button class="btn2" onclick="addToOrder('Egg Biryani', 159)">ADD</button>
            </div>
        </div><br/><br/> 

        <div class="box1">
            <img src="public\images\butter-roti.webp" alt="Biryani" />
            <div class="content1">
                <h3>Paneer Biryani</h3>
                <p>Savor the richness of our Paneer Biryani, where soft, marinated paneer cubes are perfectly cooked with aromatic, spiced basmati rice.</p>
                <button class="btn1" onclick="addToOrder('Paneer Biryani', 199)">ADD</button>
            </div>
        </div><br/><br/>
            
    </div>

    <script>
        function addToOrder(itemName, itemPrice) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';

        const itemNameInput = document.createElement('input');
        itemNameInput.type = 'hidden';
        itemNameInput.name = 'item_name';
        itemNameInput.value = itemName;

        const itemPriceInput = document.createElement('input');
        itemPriceInput.type = 'hidden';
        itemPriceInput.name = 'item_price';
        itemPriceInput.value = itemPrice;

        form.appendChild(itemNameInput);
        form.appendChild(itemPriceInput);

        document.body.appendChild(form);
        form.submit();
    }
    </script>

</body>
</html>
