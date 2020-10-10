<template>
   <div>
      <h2>Articles</h2>
      <form class="card p-2" @submit.prevent="addArticle">
         <div class="form-group">
            <input v-model="article.title" class="form-control mb-2" type="text" placeholder="title ...">
            <textarea v-model="article.body" class="form-control mb-2" cols="30" rows="3" placeholder="article content ..."></textarea>
            <button type="submit" class="btn btn-dark "> Add</button>
         </div>
      </form>
      <br>
      <div>
         <ul class="pagination">
            <li class="page-item" v-bind:class="[{disabled : !pagination.prev_page_url}]">
               <button class="page-link" type="button"
                  @click="getArticles(pagination.prev_page_url)">
                  Previous
               </button>
            </li>
            
            <li class="page-item disabled">
               <a class="page-link text-dark" href="#">
                  page {{pagination.current_page}} of {{pagination.last_page}}
               </a>
            </li>

            <li class="page-item" v-bind:class="[{disabled : !pagination.next_page_url}]">
               <button class="page-link" type="button"
                  @click="getArticles(pagination.next_page_url)">
                  next
               </button>
            </li>      
            
            
         </ul>
      </div>
      <div class=" card card-body mb-2 shadow-sm p-3 bg-white rounded-lg"
         v-for="article in articles" :key="article.id">

         <h3>{{article.title}}</h3>
         <p>{{article.body}}</p>
         <hr>
         <div class="row">
            <button type="button" class="col mx-5 btn btn-danger"
            @click="deletArtical(article.id)">
            Delete
         </button>
          <button type="button" class="col mx-5  btn btn-dark"
            @click="editArtical(article.id,article.title,article.body)">
            edit
         </button>
         </div>



      </div>
   </div>
</template>

<script>
export default {
   data(){
      return{
         articles:[],
         article:{
            id:'',
            title:'',
            body:''
         },
         article_id:'',
         pagination:{},
         edit:false,
      }
   },
   created(){
      this.getArticles();
   },
   methods:{
      getArticles(page_url){
         var page_url=page_url || 'api/articles'
         fetch(page_url)
         .then(res => res.json())
         .then(res =>{
            this.articles=res.data;
            this.makePagination(res.meta,res.links);
         })
         .catch(err => console.log(err));
      },
      makePagination(meta,links){
         this.pagination={
            current_page : meta.current_page,
            next_page : meta.next_page,
            last_page:meta.last_page,
            next_page_url:links.next,
            prev_page_url:links.prev
         }
      },
      deletArtical(id){
         if(confirm('are you sure ?')){
            fetch(`api/article/${id}`,{
               method:'delete'
            })
            .then(res => res.json())
            .then(res =>{
               alert(`article ${res.data.id} is  removed`)
               this.getArticles();
            })
            .catch(err => console.log(err));
         }    
      },
      editArtical(id,title,body){
        this.getArticles();
        this.article.id=id;
         this.article.title=title;
         this.article.body=body;
         this.edit=true;
      },
      addArticle(){
         if (this.edit === false) {
            //add
            fetch('api/article',{
               method:'post',
               body:JSON.stringify(this.article),
               headers:{
                  'content-type':'application/json'
               }
            })
            .then(res => res.json())
            .then(res =>{
               this.article.title="";
               this.article.body="";
               this.getArticles();
               alert(`new article is added`);
            })
            .catch(err => console.log(err));

         }else{
            //update
            fetch(`api/article/${this.article.id}`,{
               method:'put',
               body:JSON.stringify(this.article),
               headers:{
                  'content-type':'application/json'
               }
            })
            .then(res => res.json())
            .then(res =>{
               this.edit=false;
               this.article.title="";
               this.article.body="";
               this.article.id="";
               this.getArticles();
               alert(`article is updated`);
            })
            .catch(err => console.log(err));
         } 
      },
   }
}
</script>