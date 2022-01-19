<script>
      $(document).ready(function() {

        load_data();

        function load_data(query = '') {
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              query: query
            },
            success: function(data) {
              $('tbody').html(data);
            }
          })
        }

        $('#multi_search_filter').change(function() {
          $('#hidden_category').val($('#multi_search_filter').val());
          var query = $('#hidden_category').val();
          load_data(query);
        });

      });


      const reloadtButton = document.querySelector("#reload");
            // Reload everything:
            function reload() {
                reload = location.reload();
            }
            // Event listeners for reload
            reloadButton.addEventListener("click", reload, false);


    </script>