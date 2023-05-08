const {
    createApp
} = Vue

createApp({
    data() {
        return {
            thingsToDo: [],
            text: "",
            error: false,
            apiUrl: 'api.php'
        }
    },
    methods: {
        readList() {
            axios.get(this.apiUrl).then((res) => {
                this.thingsToDo = res.data;

            });
            setTimeout(this.todoColor, 300)

        },
        insert() {
            if (this.text.length < 3) {
                this.error = true;
                return
            }
            const newTodo = {
                todo: this.text,
                done: false,
            }
            this.sendData(newTodo);
            this.text = "";
            this.error = false;


        },
        deleteList(index) {
            const data = {
                deleteIndex: index
            }
            this.sendData(data);

        },
        checked(index) {
            const data = {
                checkIndex: index
            }
            this.sendData(data);
        },
        removeAll() {
            const data = {
                removeAll: true
            }
            this.sendData(data);
        },
        sendData(data) {
            axios.post(this.apiUrl, data, { headers: { 'Content-Type': 'multipart/form-data' } }).then((res) => {
                this.thingsToDo = res.data;
                setTimeout(this.todoColor);

            });
        },
        randomHex() {
            //Si ringrazia: https://www.w3resource.com/javascript-exercises/fundamental/javascript-fundamental-exercise-11.php
            let n = (Math.random() * 0xfffff * 1000000).toString(16); //Genera un numero casuale tra 0 e 1 con Math.random, moltiplicalo per il max valore esadecimale possibile e a sua volta moltiplicalo per un
            //numero abbastanza grande da permettere di avere un'ampia scelta di colori abbastanza unici nella propria pagina, converti poi il numero in una stringa base 16 (esadecimale)
            return '#' + n.slice(0, 6); //Ritorna # (simbolo per scrivere un hex in css), + la stringa precedente di max lunghezza 6 (quindi taglia la stringa da indice 0 per lunghezza 6)

        },
        todoColor() {
            for (li of this.$refs.todolist) {
                if (!li.style.background) {

                    li.style.background = this.randomHex()
                }
            }
        }

    },
    mounted() {
        this.readList();
    }
}).mount('#app')