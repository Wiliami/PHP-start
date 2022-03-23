<?php 


//funções recursivas
$hierarquia = array (
    array (
        'nome_cargo' => 'CEO',
        'subordinados' => array (
            //Inicio: Diretor
            array (
                'nome_cargo' => 'Diretor Comercial',
                'subordinados' => array (
                    array(
                        'nome_cargo' => 'Gerente de vendas',

                    )
                    //termino: Gerente de vendas
                )
            ),
            //Termino do Diretor comercial
            //Inicio: Diretor Financeiro 
            array (
                'nome_cargo' => 'Diretor Comercial',
                'subordinados' => array(
                    //Inicio: Gerente de contas a pagar
                    array(
                        'nome_cargo' => 'Gerente de contas a pagar',
                        'subordinados' => array(
                            //Inicio: Supervisor de pagamentos
                            array(
                                'nome_cargo' => 'Supervisor de Pagamentos',

                            )

                            //Termino: Supervisor de pagamentos
                        )
                    ),
                    //Termino: Gerente de contas a pagar
                    //Inicio: Gerente de compras 
                    array(
                        'nome_cargo' => 'Gerente de compras',
                        'subordinados' => array(
                            //Inicio: Supervisor de Suprimentos
                            array(
                                'nome_cargo' => 'supervisor de suprimentos',

                            )
                        )
                    )

                )
                //Termino: Gerente de compras
            )
            //Término: Diretor Financeiro
        )
    )

);

function exibe($cargos) {
    $html = "<ul>"; 

    foreach($cargos as $cargo)  {
        $html .= '<li>';

        $html .= $cargo['nome_cargo'];

        if (isset($cargo['subordinados']) && count($cargo['subordinados']) > 0)  {
            $html .= exibe(($cargo['subordinados']));
        }
        
        
        
    };
    $html .= '</li>';
    
 
};

$html .= "</ul>";

return $html;


//echo exibe($hierarquia);


?>