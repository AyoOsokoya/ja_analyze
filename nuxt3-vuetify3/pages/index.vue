<template>
  <VContainer>
    <VRow no-gutters align="center" justify="center" class="fill-height">
      <VCol cols="12">
        <VRow no-gutters align="center" justify="center">
          <VCol cols="8">
            <h1>Ja Analyze</h1>
            <p class="text-medium-emphasis">Enter UTF-8 Japanese text to analyze.</p>

            <VForm class="mt-7">
              <div class="mt-1">
                <VTextarea
                    :rules="[ruleRequired]"
                    v-model="textToAnalyze"
                    id="paragraph"
                    name="paragraph"
                    type=""
                />
              </div>
              <div class="mt-5">
                <VBtn
                    type="button"
                    block
                    min-height="44"
                    class="gradient primary"
                    @click="analyzeParagraph"
                >Analyze</VBtn>
              </div>
              <div class="mt-5" cols="6">
                <VBtn
                    type="button"
                    block
                    min-height="44"
                    class="gradient primary"
                    @click="clearAnalysisParagraph"
                >Clear Text</VBtn>
              </div>
            </VForm>
            <VRow>
              <h2 class="ml-5 mr-5 mt-5">Analyzed Words</h2>
              <div v-for="word in words">
                <AnalyzedWord :word="word"/>
                <br>
                <br>
              </div>
              <hr>
            </VRow>
          </VCol>
        </VRow>
      </VCol>
    </VRow>
  </VContainer>
</template>

<script setup>
const textToAnalyze = ref("すもももももももものうち");
const baseUrl = 'http://localhost/api/v1';
let words = [];
let isLoading = false;

const { ruleRequired } = useFormRules();
async function analyzeParagraph()
{
  isLoading = true;
  await $fetch(baseUrl + '/paragraph_to_words', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      paragraph: textToAnalyze.value
    })
  }).then(function (response) {
    isLoading = false;
    words = response.data;
  }).catch((error) => error.data);
}

function clearAnalysisParagraph() {
  textToAnalyze.value = "";
  words = [];
}
</script>
