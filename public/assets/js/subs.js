paypal.Buttons({

  createSubscription: function (data, actions) {


    return actions.subscription.create({


      'plan_id': document.getElementById('sub').getAttribute("data-plan-id")


    });


  },

  onApprove: function (data, actions) {

    let creator_id = document.getElementById('sub').getAttribute("data-id");

    //console.log(data); 

    json = {

      'sub_id': data.subscriptionID,

      'creator_id': creator_id

    };

    Subscriptions.add(JSON.stringify(json));

    document.getElementById("m-window").remove();


  }


}).render('#paypal-button-container');
