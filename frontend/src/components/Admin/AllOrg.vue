<template>
      <div class="w-full h-screen flex justify-center items-start overflow-scroll">
    <div class="w-full p-4 mt-20">
      <table class="w-full border">
        <thead>
          <tr class="bg-orange-50 border-b">
            <th
              class="p-2 border-r cursor-pointer text-sm font-bold text-gray-500"
            >
              <div class="flex items-center justify-center">
                Name
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"
                  />
                </svg>
              </div>
            </th>
            <th
              class="p-2 border-r cursor-pointer text-sm font-bold text-gray-500"
            >
              <div class="flex items-center justify-center">
                Email
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"
                  />
                </svg>
              </div>
            </th>
            <th
              class="p-2 border-r cursor-pointer text-sm font-bold text-gray-500"
            >
              <div class="flex items-center justify-center">
                Address
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"
                  />
                </svg>
              </div>
            </th>
            <th
              class="p-2 border-r cursor-pointer text-sm font-bold text-gray-500"
            >
              <div class="flex items-center justify-center">
                Action
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 9l4-4 4 4m0 6l-4 4-4-4"
                  />
                </svg>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="Org in information"
            :key="Org"
            class="bg-gray-100 text-center border-b text-sm text-gray-600"
          >
            <td class="p-2 border-r">{{ Org["FirstName"] }}</td>
            <td class="p-2 border-r">{{ Org["Email"] }}</td>
            <td class="p-2 border-r">{{ Org["Address"] }}</td>
            <td class="p-4 flex gap-4 justify-center items-center">
              <a
                href="#"
                class="bg-red-500 p-2 text-white hover:shadow-lg font-normal w-32"
                @click="ArchiverDemande(Org)"
                >Archiver</a
              >
              <div class="modal">
                <button
                  id="modal__trigger"
                  for="modal__trigger"
                  @click="infoDetails = Org"
                >
                  Details
                </button>
                <div
                  v-if="infoDetails"
                  class="modal__overlay"
                  role="dialog"
                  aria-labelledby="modal__title"
                  aria-describedby="modal_desc"
                >
                  <div class="modal__wrap">
                    <label @click="infoDetails = ''" for="modal__trigger"
                      >&#10006;</label
                    >
                    <h2 id="modal__title"></h2>
                    <h2 id="modal__title">{{ infoDetails["FirstName"] }}</h2>
                    <h2 id="modal__title">{{ infoDetails["LastName"] }}</h2>
                    <h2 id="modal__title">
                      {{ infoDetails["business_name"] }}
                    </h2>
                    <h2 id="modal__title">{{ infoDetails["Email"] }}</h2>
                    <h2 id="modal__title">{{ infoDetails["Phone"] }}</h2>
                    <h2 id="modal__title">{{ infoDetails["Address"] }}</h2>
                    <h2 id="modal__title">{{ infoDetails["NumSTadieum"] }}</h2>
                    <h2 id="modal__title">{{ infoDetails["Ville"] }}</h2>
                    <h2 id="modal__title">{{ infoDetails["Jour"] }}</h2>
                    <h2 id="modal__title">
                      {{ infoDetails["business_name"] }}
                    </h2>
                    <h2 id="modal__title">{{ infoDetails["id"] }}</h2>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "dash-bord",
  data() {
    return {
      information: "",
      detail: false,
      infoDetails: "",
    };
  },
  methods: {
    Organisateur() {
      axios
        .get(`${this.$apiUrl}/Organisateur/selectOrg`)
        .then((response) => {
          this.information = response.data;
          console.log(this.information);
        });
    },
    details(data) {
      console.log(data.id);
      this.detail = true;
      this.infoDetails = data;
    },
    ArchiverDemande(data) {
        console.log(data.id);
        console.log(data.idOrganisateur);
      axios
        .post(`${this.$apiUrl}/Organisateur/updatesuspended`, {
          Suspended: "X",
          id: data.idOrganisateur,
        })
        .then((response) => {
          console.log(response);
          this.information = this.information.filter(function (iteam) {
            return iteam.idOrganisateur != data.idOrganisateur;
          });
        });
    },
  },
  mounted() {
    this.Organisateur();
  },
};
</script>

<style lang="scss" scoped>
@import url(https://fonts.googleapis.com/css?family=Lato:300,400,900);
@import url(https://fonts.googleapis.com/css?family=Audiowide);

$lato: "Lato", sans-serif;

//color
$yellow: #ffd300;
$white: #f2f1f1;
$black: #000000;
$black-light: #5e5e5e;

//font weights:
$thin: 300;
$normal: 400;
$bold: 900;

body {
  background: $white;
  color: $black-light;
  font-family: $lato;
  font-weight: $thin;
  text-shadow: 1px 1px 1px #fff;
  text-align: center;
}

h1 {
  @media (min-width: 500px) {
    font-size: 2.25em;
    font-size: 7vw;
  }

  @media (min-width: 1000px) {
    font-size: 4.5em;
  }
}

h2 {
  font-size: 1em;
  line-height: 1.2;
  margin: 1.414em 0 0.5em;

  @media (min-width: 500px) {
    font-size: 1.5em;
  }

  @media (min-width: 800px) {
    font-size: 1.8em;
  }
}

h1 {
  color: $black;
  font-family: "Audiowide", cursive;
  font-weight: $bold;
  margin: 0.5em 0 2.5em;
  span {
    color: $yellow;
  }
}

.wrap {
  padding: 1em;
  text-align: center;
  @media (min-width: 700px) {
    padding: 1em 2em;
  }
}

.modal {
  background: #fff;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
  display: inline-block;
}

.modal > button {
  background: #ffd300;
  border: 1px solid #f0c600;
  border-radius: 0.2em;
  color: #000000;
  cursor: pointer;
  display: inline-block;
  font-weight: bold;
  padding: 0.75em 1.5em;
  text-shadow: 1px 1px 1px #fff;
  transition: all 0.55s;
}
.modal > label:hover {
  transform: scale(0.97);
}
.modal__overlay {
  background: #00000091;
  bottom: 0;
  left: 0;
  position: fixed;
  right: 0;
  text-align: center;
  text-shadow: none;
  top: 0;
  z-index: 600;
}
// .modal__wrap {
//   position: relative;
//   margin: 0 auto;
// width: 90%;
// }
@media (min-width: 50em) {
  .modal__wrap {
    padding: 1.75em;
  }
}
@media (min-height: 37.5em) {
  .modal__wrap {
    left: 50%;
    position: absolute;
    top: 80%;
    transform: translate(-50%, -80%);
  }
}

.modal__wrap label {
  background: #ffd300;
  border-radius: 50%;
  color: #000000;
  cursor: pointer;
  display: inline-block;
  height: 1.5em;
  line-height: 1.5;
  position: absolute;
  right: 0.5em;
  top: 0.5em;
  width: 1.5em;
}
.modal__wrap h2 {
  color: #ffd300;
  margin-bottom: 1em;
  text-transform: uppercase;
}
.modal__wrap p {
  color: #ffd300;
  text-align: justify;
}
.modal input:focus ~ label {
  transform: scale(0.97);
}

input {
  position: absolute;
  top: -1000px;
}

.modal__overlay {
  opacity: 0;
  transform: scale(0.5);
  transition: all 0.75s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  z-index: -100;
}

.modal__overlay {
  opacity: 1;
  transform: scale(1);
  z-index: 800;
}
</style>
