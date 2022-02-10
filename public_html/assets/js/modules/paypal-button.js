
paypal.Buttons({

  style: {
    color: 'blue'

    
  },

  createSubscription: function (data, actions) {


    return actions.subscription.create({


      'plan_id': sessionStorage.getItem('sub-plan_id')


    });


  },

  onApprove: function (data, actions) {
  
    let creator_id = document.getElementById('exe-sub').getAttribute("data-id");
    let version = sessionStorage.getItem('sub-version');
    let plan_id = sessionStorage.getItem('sub-plan_id');
    let stock = sessionStorage.getItem('sub-in-stock');
   
    json = {

      'sub_id': data.subscriptionID,
      'creator_id': creator_id,
      'plan_id': plan_id,
      'order_id': data.orderID,
      'version': version,
      'stock': stock

    };
    document.getElementById("m-window").remove();
    Subscriptions.complete(JSON.stringify(json));
    

  }


}).render('#paypal-button-container');
