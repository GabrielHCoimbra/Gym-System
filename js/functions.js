function mask($field) {
    if ($field=='CPF') {
        const input = document.getElementById($field);

        var v=input.target.value.replace(/\D/g,"");
        
        v=v.replace(/(\d{3})(\d)/,"$1.$2");
        
        v=v.replace(/(\d{3})(\d)/,"$1.$2");
        
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
        
        input.target.value = v;
        
    }
}