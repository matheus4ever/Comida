<?php

require_once("modelo/Pedido.php");
require_once("modelo/Prato.php");

echo "| NÚMERO |        NOME          | VALOR (R$) |\n";
echo "| 1      | Camarão à Milanesa   | 110,00     |\n";
echo "| 2      | Pizza Margherita     | 80,00      |\n";
echo "| 3      | Macarrão à Carbonara | 60,00      |\n";
echo "| 4      | Bife à Parmegiana    | 75,00      |\n";
echo "| 5      | Risoto ao Funghi     | 70,00      |\n";

$pratos = array(
    new Prato(1, "Camarão à Milanesa", 110.00),
    new Prato(2, "Pizza Margherita", 80.00),
    new Prato(3, "Macarrão à Carbonara", 60.00),
    new Prato(4, "Bife à Parmegiana", 75.00),
    new Prato(5, "Risoto ao Funghi", 70.00)
);

$pedidos = [];

print_r($pratos);

do {
    echo "\n\n------BONA COMIDA------\n";
    echo "1- Cadastrar\n";
    echo "2- Cancelar\n";
    echo "3- Listar\n";
    echo "4- Total de Vendas\n";
    echo "0- Sair\n";
    $opcao = readline("Informe a opção: ");

    switch($opcao) {
        case 1:
            $numeroPrato = readline("Informe o número do pedido: ");
            $pratoEscolhido = null;
            foreach($pratos as $pr){
                if($pr->getNumero() == $numeroPrato){
                    $pratoEscolhido = $pr;
                }
            }
            if ($pratoEscolhido == null) {
                echo "Prato não encontrado\n";
                break;
            }
            
            $p = new Pedido (
            readline("Informe o nome do cliente: "),
            readline("Informe o nome do garçom: "),
            $pratoEscolhido
            );
            $pedidos[] = $p;
            break;

        case 2:
            foreach($pedidos as $i => $p){
                echo "[$i] " . $p . "\n";
            }
            $excluiPedido = readline("Informe o número do pedido que vc quer deletar: ");
            array_splice($pedidos, $excluiPedido, 1);
            echo "Pedido deletado!";
            break;

        case 3:
            foreach($pedidos as $p){
                echo $p . "\n";
            }
            break;

        case 4:
            $total = 0;
            foreach($pedidos as $p){
                $total += $p->getPrato()->getValor();
            }
            echo "Total de vendas: R$ " . $total . "\n";
            break;
        case 0:
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opção inválida!\n";            
    }

} while($opcao != 0);