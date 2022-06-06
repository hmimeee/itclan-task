<template>
  <div v-if="user">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group ic-cmp-int">
          <div class="form-ic-cmp">
            <i class="notika-icon notika-support"></i>
          </div>
          <div class="nk-int-st">
            <input
              type="text"
              class="form-control"
              placeholder="Full Name"
              v-model="ideaData.name"
            />
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group ic-cmp-int">
          <div class="form-ic-cmp">
            <i class="notika-icon notika-mail"></i>
          </div>
          <div class="nk-int-st">
            <input
              type="email"
              class="form-control"
              placeholder="Email Address"
              v-model="ideaData.email"
            />
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group ic-cmp-int">
          <div class="form-ic-cmp">
            <i class="notika-icon notika-edit"></i>
          </div>
          <div class="nk-int-st">
            <input
              type="text"
              class="form-control"
              placeholder="Idea Details"
              v-model="ideaData.idea"
            />
          </div>
        </div>
      </div>

      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
        <div class="form-group">
          <button class="btn btn-sm btn-primary" @click="submitIdea()">
            Submit
          </button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
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
                    <th>Name</th>
                    <th>Idea</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="idea in ideas" v-bind:key="idea.id">
                    <td class="f-500 c-cyan">{{ idea.id }}</td>
                    <td>{{ idea.name }}</td>
                    <td>{{ idea.idea }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
          <div class="rc-it-ltd">
            <div class="recent-items-ctn">
              <div class="recent-items-title">
                <h2>Recent Tournaments</h2>
              </div>
            </div>
            <div class="recent-items-inn">
              <table class="table table-inner table-vmiddle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th style="width: 60px">Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="tournament in tournaments" v-bind:key="tournament.id">
                    <td class="f-500 c-cyan">{{tournament.id}}</td>
                    <td>{{tournament.name}}</td>
                    <td class="f-500 c-cyan">{{tournament.status}}</td>
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
import { computed, onMounted, ref } from "@vue/runtime-core";
import { useStore } from "vuex";
import useIdeas from "@/composable/ideas";
import useTournaments from "../composable/tournament";

export default {
  setup() {
    const vuexStore = useStore();
    const user = computed(() => vuexStore.getters["auth/user"]);
    const ideas = computed(() => vuexStore.getters["idea/ideas"]);
    const tournaments = computed(
      () => vuexStore.getters["tournament/tournaments"]
    );
    const ideaData = ref({});
    const { storeIdea, getIdeas } = useIdeas();
    const { getTournaments } = useTournaments();

    const submitIdea = async () => {
      await storeIdea(ideaData.value);
      ideaData.value = {};
      await getIdeas();
    };

    onMounted(async () => {
      await getIdeas();
      await getTournaments();
    });

    return {
      user,
      ideaData,
      submitIdea,
      ideas,
      tournaments
    };
  },
};
</script>
