<template>
  <VContainer>
    <VCol cols="9" no-gutters>
      <VRow><strong>Surface Form:</strong>&nbsp;{{ word.word.slug }}</VRow>
      <VRow><strong>English Definitions:</strong>&nbsp;</VRow>
      <VRow>
        <ul>
          <li v-for="sense in word.senses">
            &nbsp;&nbsp;&nbsp;{{ sense.english_definitions.join(", ") }}
          </li>
        </ul>
      </VRow>
      <VRow><strong>Readings:</strong>&nbsp;</VRow>
      <VRow>
        <ul class="mt-3 ml-0 pl-0 d-block">
          <li v-for="reading in word.readings" class="ml-0 pl-0 d-block">
            {{ reading.reading }},&nbsp;
          </li>
        </ul>
      </VRow>
      <VRow class="d-block"><strong>Parts of Speech:</strong>&nbsp;</VRow>
      <VRow class="d-block">
        <ul>
          <li v-for="sense in word.senses" class="ml-0 pl-0 d-block">
            {{ sense.parts_of_speech.join(", ") }}
          </li>
        </ul>
      </VRow>
      <!--
    <VRow>
    <VBtn cols="3"
        type="submit"
        min-height="44"
        class="gradient primary"
        @click="toggleWordMemorization"
    >
      <span v-if="isWordMemorized">Add to My Vocabulary</span>
      <span v-else>Remove from My Vocabulary</span>
    </VBtn>
     -->
<!--      </VRow>-->
    </VCol>
  </VContainer>
</template>

<script setup>

import {defineProps, reactive} from "vue";

// const surfaceForm = ref("surface_form");
// const partsOfSpeech = ref("parts_of_speech");
// const meanings = ref("meanings");
// const senses = ref("senses");
// // const addRemoveWord = ref("add_remove");
// const isWordMemorized = ref(false);

const props = defineProps({
  word: {
    surface_form: String,
    parts_of_speech: String,
    meanings: String,
    senses: String,
  }
});

function toggleWordMemorization() {
  isWordMemorized.value = !isWordMemorized.value;
}

</script>

<style scoped>

</style>