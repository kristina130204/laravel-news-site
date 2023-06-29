<template>
  <ul class="chat-ul">
    <li class="left clearfix" v-for="message in messages" :key="message.id">
      <div class="clearfix">
          <strong>
            {{ message.user.name }}: 
          </strong>
        <span>
          {{ message.message }}
        </span>
      </div>
    </li>
  </ul>
</template>
<script>
export default {
  props: ["messages"],
};
</script>
