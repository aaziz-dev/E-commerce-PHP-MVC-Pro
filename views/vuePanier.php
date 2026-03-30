<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AXWJj9FvNaI2DI1iltfiDaA-A-up882ztZk8j0IlldoxyQ7Ax21TOu34KCpndHm2wD6fXyXxNob5Uelo&currency=EUR"></script> <!-- Remplacez par votre client ID PayPal -->
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Votre Panier</h2>
        <?php if (!empty($_SESSION['panier'])) : ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['panier'] as $item) : ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nom']); ?></td>
                                <td><?= htmlspecialchars($item['prix']); ?>€</td>
                                <td><?= htmlspecialchars($item['quantite']); ?></td>
                                <td><?= htmlspecialchars($item['prix'] * $item['quantite']); ?>€</td>
                                <td>
                                    <a href="index.php?action=retirerPanier&id_produit=<?= $item['id_produit']; ?>" 
                                       class="btn btn-danger btn-sm">Retirer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p class="text-end"><strong>Total général :</strong> 
                <?= $totalPanier = array_sum(array_map(fn($item) => $item['prix'] * $item['quantite'], $_SESSION['panier'])); ?>€
            </p>

            <div id="paypal-button-container" class="text-center mt-4"></div>
            <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '<?= $totalPanier; ?>' // Montant total du panier
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                    
                    return actions.order.capture().then(function(details) {
                        alert('Paiement effectué avec succès par ' + details.payer.name.given_name);
                        window.location.href = "index.php?action=enregistrerCommande";
                    });
                },
                    onError: function(err) {
                        console.error('Erreur lors du paiement :', err);
                        alert('Une erreur est survenue lors du paiement.');
                    }
                }).render('#paypal-button-container');
            </script>
        <?php else : ?>
            <p class="alert alert-warning text-center">Votre panier est vide.</p>
        <?php endif; ?>
    </div>
</body>
</html>
