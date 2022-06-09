<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
          <div class="rc-it-ltd">
            <div class="recent-items-ctn">
              <div class="recent-items-title">
                <h2>Tournament Details</h2>
              </div>
            </div>
            <div class="recent-items-inn">
                <div class="font-bold mt-5">ID: {{ tournament?.id }}</div>
                <div class="">Name: {{ tournament?.name }}</div>
                <div class="">Status: {{ tournament?.status }}</div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
          <div class="rc-it-ltd">
            <div class="recent-items-ctn">
              <div class="recent-items-title">
                <h2>Recent Ideas</h2>
              </div>
            </div>
            <div class="recent-items-inn">
              <table class="table table-inner table-vmiddle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Idea</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody v-if="tournament.ideas">
                  <tr v-for="idea in tournament.ideas" v-bind:key="idea.id">
                    <td class="f-500 c-cyan">{{ idea.id }}</td>
                    <td>{{ idea.user.name }}</td>
                    <td>{{ idea.idea }}</td>
                    <td>{{ idea.status?.phase ?? "--" }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, onMounted } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import useTournaments from "../composable/tournament";

export default {
  setup() {
      const route = useRoute()
      const vuexStore = useStore();
      const tournament = computed(
      () => vuexStore.getters["tournament/tournament"]
    );
    const { getTournament } = useTournaments();

    onMounted(async () => {
      await getTournament(route.params.tournamentId);
    });

    return {
        tournament
    }
  },
};
</script>
