
app = {
    root : document.querySelector(".questions"),
    btnFix : null,
    btnPre : null,
    btnNext : null,
    btnSubmit : null,
    btnRefresh : null,
    dataJson:null,
    questions:[],
    index:0,
    setDefault(){
        this.btnFix = document.querySelector(".btn-fix");
        this.btnPre = document.querySelector(".btn-pre");
        this.btnNext = document.querySelector(".btn-next");
        this.btnSubmit = document.querySelector(".btn-submit");
        this.btnRefresh = document.querySelector(".btn-refresh");
        this.btnNext.removeAttribute("hidden");
        this.btnPre.removeAttribute("hidden");
        this.btnSubmit.removeAttribute("hidden");
        this.btnRefresh.setAttribute("hidden",true);
    },
    async fetchData(url=""){
        return await fetch(url)
        .then(data=>{
                    return data.json();
                })
                .then(data=>{
                    return data.questions;
                })
    },
    async getShow(){
        this.dataJson = await this.fetchData("http://localhost:8080/PHP-JQuery-MySQL/restfulApi/api/questions/read.php");
        myData = this.dataJson.map((question,index)=>{
            return `
                <div class="question" id="${question.id}" hidden>
                    <h2 class="title">${index +1}. ${question.title}</h2>
                    <ul class="answer">
                        <li> 
                            <input type="radio" id="${question.id}-a" value=1 name="${question.id}">
                            <label for="${question.id}-a"> 
                                ${question.a}
                            <label/>
                        </li>
                        <li> 
                            <input type="radio" id="${question.id}-b" value=2 name="${question.id}">
                            <label for="${question.id}-b"> 
                            ${question.b}
                            <label/>
                        </li>
                        <li> 
                            <input type="radio" id="${question.id}-c" value=3 name="${question.id}">
                            <label for="${question.id}-c"> 
                            ${question.c}
                            <label/>
                        </li>
                        <li> 
                            <input type="radio" id="${question.id}-d" value=4 name="${question.id}">
                            <label for="${question.id}-d"> 
                            ${question.d}
                            <label/>
                        </li>
                    </ul>
                </div>
            `
        })
        var html = myData.join("");
        this.root.innerHTML = html;
        this.questions = document.querySelectorAll(".question");
        this.questions = Array.from(this.questions);
    },
    show(index){
        this.questions.forEach(question => {
            question.setAttribute("hidden",true); 
        });
        this.questions[index].removeAttribute("hidden"); 
    },
    handleSubmit(){
        const numAnswer = this.questions.reduce((curValue,question,index)=>{
            const radio = question.querySelector("input:checked");
            if (radio && radio.value == this.dataJson[index].answer){
                return curValue + 1;
            }
            return curValue;
        },0)
        if (numAnswer < 25){
            const notice = `
                <h1 class="title">Cuộc thi thử vận may</h1>
                <h1>Bạn quá đen :)</h1>
                <h2>Điểm số của bạn là :${numAnswer}/${this.questions.length} </h2?
            `
            this.root.innerHTML = notice;
        } else{
            const notice = `
                <h1 class="title">Cuộc thi thử vận may</h1>
                <h1>Bạn là xuân tóc đỏ <3</h1>
                <h2>Điểm số của bạn là :${numAnswer}/${this.questions.length} </h2?
            `
            this.root.innerHTML = notice;
        }
        this.btnNext.setAttribute("hidden",true);
        this.btnPre.setAttribute("hidden",true);
        this.btnSubmit.setAttribute("hidden",true);
        this.btnRefresh.removeAttribute("hidden");
    },
    async run(){
        this.setDefault();
        await this.getShow();
        this.show(this.index);
        document.onscroll = ()=>{
            this.btnFix.style.bottom = `${Math.ceil(20 + 40*Math.random())}px`;
            this.btnFix.style.right = `${Math.ceil(20 + 40*Math.random())}px`;
        }
        this.btnPre.onclick=()=>{
            this.index = this.index != 0 ? --this.index: this.questions.length-1;1
            this.show(this.index);
        }
        this.btnNext.onclick=()=>{
            this.index = this.index != this.questions.length-1? ++this.index : 0;
            this.show(this.index);
        }
        this.btnSubmit.onclick = ()=>{
            this.handleSubmit();
        };
        this.btnRefresh.onclick = ()=>{
            this.run();
        }
    }
};
app.run();
