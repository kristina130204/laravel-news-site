import './bootstrap';  
const obj = {};
const categArray = [];
const articArray = [];
const dataArray = []; 
const commentArray = [];
const objComment = {};
const titleArray = [];

window.onload = () => {
  document.querySelector(".preloader").remove();
}

if(document.querySelector('#chat')){
    document.querySelector('#chat').addEventListener('click', () => {
      document.querySelector('.chat-ul').scrollIntoView({block: "end", inline: "nearest", behavior: "smooth"});
  })
}

let mode = localStorage.getItem('mode');
mode === 'dark' ? document.body.classList.add("dark-mode") : document.body.classList.remove("dark-mode");

if(document.querySelector(".mode-toggler")){
  document.querySelector(".mode-toggler").addEventListener('click', () => {
    document.body.classList.toggle("dark-mode");
    let mode = localStorage.getItem('mode');
    if(mode === 'dark'){
      localStorage.setItem('mode', 'light');
    } else{
      localStorage.setItem('mode', 'dark');
    }
  });
}

if(document.querySelector('.burger-div')){
  document.querySelector('.burger-div').addEventListener('click', () => {
    document.querySelector('.menu').classList.toggle('menu-mob');
  })
}

if(document.querySelector('#myChartArticles')){
  const ctx = document.querySelector('#myChartArticles');
  const dataCategories = ctx.dataset.categories;  
  const dataArticles = ctx.dataset.articles;
  const categories = JSON.parse(dataCategories);
  const articles = JSON.parse(dataArticles);
  articles.forEach(artic => {
    articArray.push(artic);
  });
  categories.forEach(categ => { 
    categArray.push(categ.name);
    obj[categ.name] = articArray.filter(artic => {if(categ.id === artic.category_id){return artic}});
  });
  categArray.forEach(categ=>dataArray.push(obj[categ].length));
    new Chart(ctx, {
    type: 'bar',
    data: {
      labels: categArray,
      datasets: [{
        label: '# of articles',
        data: dataArray,
        borderWidth: 1
      }]
    },
  });
}
  if(document.querySelector('#myChartComments')){
  const ctx2 = document.querySelector('#myChartComments');
  const dataComments = ctx2.dataset.comments  ?? '';  
  const comments = JSON.parse(dataComments);
    articArray.forEach(artic=>{
      titleArray.push(artic.title);
      objComment[artic.title] = comments.filter(comment => {if(artic.id === comment.article_id){return comment}});
    })
  titleArray.forEach(artic=>commentArray.push(objComment[artic].length));
    new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: titleArray,
      datasets: [{
        label: '# of comments',
        data: commentArray,
        borderWidth: 1
      }]
    },
    options: {
      indexAxis: 'y',
    },
  });
  }
  if(document.querySelector('.search-q')){
    const queryInput = document.querySelector('.search-q');
    queryInput.addEventListener('input', async () => {
    document.querySelector(".search-result")?.remove();
    const value = queryInput.value;
    if(value.length < 2) return;
    const res = await axios({
        method: 'get',
        url: "/search-ajax?q=" + value,
    });
    const {data, total} = res.data;
    let html = `
    <div class="search-result">`;
    data.forEach(article => {
        html += `
        <div class="article">
        <a href="/article/${article.slug}">
        <div class="image">
        <img src="${article.image}" alt="${article.title}">
        </div>
        <div class="title">
        ${article.title}
        </div>
        </a>
        </div>
        `
    });
    html += total > 0 ? `<a href="/search?q=${value}"><strong>Total: ${total}</strong></a></div>` : `No results found</div>`;
    document.querySelector(".searchForm").insertAdjacentHTML('beforeend', html);
});
document.addEventListener('click', (e) => {
    document.querySelector('.search-result')?.remove();
})
}

if(document.querySelector('.search-posts')){
  const queryInput = document.querySelector('.search-posts-ajax');
  queryInput.addEventListener('input', async () => {
  document.querySelector(".search-result")?.remove();
  const value = queryInput.value;
  if(value.length < 2) return;
  const res = await axios({
      method: 'get',
      url: "/search-ajax-posts?q=" + value,
  });
  const {data, total} = res.data;
  let html = `
  <div class="search-result">`;
  data.forEach(post => {
      html += `
      <div class="article">
      <a href="/post/${post.slug}">
      <div class="image">
      <img src="${post.image}" alt="${post.title}">
      </div>
      <div class="title">
      ${post.title}
      </div>
      </a>
      </div>
      `
  });
  html += total > 0 ? `<a href="/search-posts?q=${value}"><strong>Total: ${total}</strong></a></div>` : `No results found</div>`;
  document.querySelector(".search-posts").insertAdjacentHTML('beforeend', html);
});
document.addEventListener('click', (e) => {
  document.querySelector('.search-result')?.remove();
})
}

import { createApp } from 'vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

const app = createApp({
  el: '#chat',
  data(){
      let messages = [];
      return {messages};
  },
  created() {
      this.fetchMessages();
  },
  methods: {
      fetchMessages() {
          axios.get('/messages').then(response => {
              this.messages = response.data;
          });
          window.Echo.private('chat')
          .listen('MessageSent', (e) => {
            this.messages.push({
              message: e.message.message,
              user: e.user
            });
          });
      },
      addMessage(message) {
          this.messages.push(message);
          axios.post('/messages', message).then(response => {
              console.log(response.data);
          });
      }
  }
});
app.component('chat-messages', ChatMessages);
app.component('chat-form', ChatForm);
app.mount('#chat');

if(document.querySelector('.chat-btn')){
  const chatBtn = document.querySelector('.fa-comments');
  chatBtn.addEventListener('click', () => {
    document.querySelector('.chat-div').classList.toggle('hidden');
    document.querySelector('.chat-ul').scrollIntoView({block: "end", inline: "nearest"});
  })
}

var lfm = function(id, type, options) {
  let button = document.getElementById(id);
  if(button){
      button.addEventListener('click', function () {
  var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
  var target_input = document.getElementById(button.getAttribute('data-input'));
  var target_preview = document.getElementById(button.getAttribute('data-preview'));
  
  window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
  window.SetUrl = function (items) {
    var file_path = items.map(function (item) {
      return item.url;
    }).join(',');
  
    // set the value of the desired input to image url
    target_input.value = file_path;
    target_input.dispatchEvent(new Event('change'));
  
    // clear previous preview
    target_preview.innerHTML = '';
  
    // set or change the preview image src
    items.forEach(function (item) {
      let img = document.createElement('img')
      img.setAttribute('style', 'height: 5rem')
      img.setAttribute('src', item.thumb_url)
      target_preview.appendChild(img);
    });
  
    // trigger change event
    target_preview.dispatchEvent(new Event('change'));
  };
  });
  }
  };
  if(document.querySelector('.to-up')){
    const toUpBtn = document.querySelector('.to-up');
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        toUpBtn.style.display = "flex";
      } else {
        toUpBtn.style.display = "none";
      }
    }
    toUpBtn.addEventListener('click', () => {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    })
  }
  if(document.querySelector('.share')){
    const shareBtn = document.querySelector('.share');
    shareBtn.addEventListener('click', (e) => {
      const shareButtons = shareBtn.lastChild;
      shareButtons.classList.toggle('hidden');
    })
  }
  if(document.querySelectorAll('.reply-span')){
    document.querySelectorAll('.reply-span').forEach(reply => {
      reply.addEventListener('click', (e)=>{
        const repliesParent = e.target.parentElement;
        const replies = repliesParent.nextSibling.nextSibling;
        if(replies)
          replies.classList.toggle('hidden');
          })
    })
    document.querySelectorAll('.leave-reply').forEach(reply => {
      reply.addEventListener('click', (e)=>{
        const repliesParent = e.target.parentElement;
        const leaveReply = repliesParent.previousSibling.previousSibling;
        if(leaveReply)
          leaveReply.classList.toggle('hidden');
        })
    })
  }
  var route_prefix = "/laravel-filemanager";
  lfm('lfm', 'image', {prefix: route_prefix});
  lfm('lfm2', 'file', {prefix: route_prefix});  
  const options = {
  filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
  filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
  filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
  filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='}

CKEDITOR.replace('content', options);