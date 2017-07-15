<input type="button" onclick="ustanovit_fon(body, 'white');"
       value="Белый" />


<input type="button" onclick="ustanovit_fon(body, 'red');"
value="Красный" />


<script>
    function ustanovit_fon(el, cl) {
el.style.backgroundColor = cl;
}
</script>