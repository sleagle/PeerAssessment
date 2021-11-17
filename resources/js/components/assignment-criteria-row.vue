<template>
      <tr>
        <td align='center'> {{ criteria.description }} <br><p>({{ criteria.mark }} marks)</p> </td>

        <td v-if="!criteria.hdCriteria.subCriteria"> {{ criteria.hdCriteria.description }} </td>
        <td v-if="criteria.hdCriteria.subCriteria">
          {{ criteria.hdCriteria.description }}
          <p v-for="hdSub in criteria.hdCriteria.subCriteria">
            &bullet; ( {{ hdSub.mark }} )<br>{{ hdSub.description }}
          </p><br>
        </td>

        <td v-if="!criteria.dnCriteria.subCriteria"> {{ criteria.dnCriteria.description }} </td>
        <td v-if="criteria.dnCriteria.subCriteria">
          {{ criteria.dnCriteria.description }}
          <p v-for="hdSub in criteria.dnCriteria.subCriteria">
            &bullet; ( {{ hdSub.mark }} )<br>{{ hdSub.description }}
          </p><br>
        </td>

        <td v-if="!criteria.crCriteria.subCriteria"> {{ criteria.crCriteria.description }}</td>
        <td v-if="criteria.crCriteria.subCriteria">
          {{ criteria.crCriteria.description }}
          <p v-for="hdSub in criteria.crCriteria.subCriteria">
            &bullet; ( {{ hdSub.mark }} )<br>{{ hdSub.description }}
          </p><br>
        </td>

        <td v-if="!criteria.ppCriteria.subCriteria"> {{ criteria.ppCriteria.description }}</td>
        <td v-if="criteria.ppCriteria.subCriteria">
          {{ criteria.ppCriteria.description }}
          <p v-for="hdSub in criteria.ppCriteria.subCriteria">
            &bullet; ( {{ hdSub.mark }} )<br>{{ hdSub.description }}
          </p><br>
        </td>

        <td> {{ criteria.nnDescription }} </td>
        <td hidden></td>
      </tr>
</template>

<script>
export default {
  name: "assignment-criteria-row",
  props: ['criteria']
}
</script>

<style scoped>

</style>