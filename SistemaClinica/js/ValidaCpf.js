/**
 * Description of Paciente
 *
 * @author Felipe
 */

// TRATAMENTO DE ERROS
function Verificar_CPF(){
    switch (ValidacaoCPF($('#cpfi').val())) {
        case 0:
            $('#cpfi').popover('hide'); 
            return true;
            break;
        case 1:
            $('#cpfi').popover('show'); 
            return false;
            break;
        case 2:
            $('#cpfi').popover('show'); 
            return false;
            break;
        case 3:
            $('#cpfi').popover('show'); 
            return false;
            break;
        case 4:
            $('#cpfi').popover('hide');  
            return false;
            break;

    }

}

// FUNÇÃO DE VALIDAÇÃO DOS CAMPOS CPF
function ValidacaoCPF(num_cpf) {
   
    cpf = num_cpf.replace(/[^0-9]/g,'');

    if (cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
        return 1;
    
    else if(cpf==""){
        return 4;
    }

    if (cpf.length != 11)
        return 2;

    add = 0;

    for (i = 0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return 3;
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return 3;

    return 0;
}

