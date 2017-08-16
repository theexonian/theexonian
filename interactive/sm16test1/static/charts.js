$(function() {
 $('#participants .graph1').highcharts({
    chart: {
      width: 470,
      height: 400,
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Participants\' Time at Exeter',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Participation',
      colorByPoint: true,
      data: [{
        name: '1 Year',
        y: 205,
      }, {
        name: '2 Years',
        y: 145,
      }, {
        name: '3 Years',
        y: 133,
      }, {
        name: '4 Years',
        y: 128,
      }, {
        name: '5 Years',
        y: 0,
      }],
    }],
  });
  $('#participants .graph2').highcharts({
    chart: {
      width: 470,
      height: 400,
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Participants\' Gender',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        
        
      },
    },
    series: [{
      name: 'Participants',
      colorByPoint: true,
      data: [{
      	name: 'Other',
      	y: 16
      }, {
        name: 'Man',
        y: 282,
      }, {
        name: 'Woman',
        y: 317,
      }],
    }],
  });
  $('#information .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Regarding your time at Exeter, where did you receive the most knowledge/resources/info about sexual misconduct/related issues from?',
    },
    xAxis: {
      categories: ['Administrators', 'Advisor', 'Clubs', 'Dorm Friends', 'Proctors/Student Listeners', 'Friends', 'Health Class', 'Newspaper', 'Coaches', 'Sports Teams', 'Social Media', 'Teachers', 'Other'],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [41, 53, 23, 45, 52, 50, 64, 19, 2, 5, 25, 17, 20],
    }, {
      name: 'Lowers',
      data: [15, 51, 24, 58, 43, 69, 68, 27, 4, 5, 44, 10, 8],
    }, {
      name: 'Uppers',
      data: [21, 50, 18, 78, 52, 94, 62, 37, 3, 10, 55, 16, 11],
    }, {
      name: 'Seniors',
      data: [37, 46, 32, 75, 60, 97, 54, 36, 7, 15, 69, 17, 16],
    }],
    tooltip: { valueSuffix: '%' },
  });
 $('#programming .graph').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'How do you feel about the amount of school programming on sexual misconduct? (Assemblies, required appointments, programming incl. Cindy Pierce, etc.)',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of respondents',
      colorByPoint: true,
      data: [{
        name: 'Far too little',
        y: 2.12,
      }, {
        name: 'Too little',
        y: 14.50,
      }, {
        name: 'Good amount',
        y: 52.28,
      }, {
        name: 'Too much',
        y: 21.17,
      }, {
        name: 'Far too much',
        y: 9.93,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#isproblem .graph1').highcharts({
    chart: {
      width: 470,
      height: 400,
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Do you think there is a sexual misconduct problem at Exeter? (Male respondents)',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Participants',
      colorByPoint: true,
      data: [{
        name: 'Yes',
        y: 40.50,
      }, {
        name: 'No',
        y: 59.50,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#isproblem .graph2').highcharts({
    chart: {
      width: 470,
      height: 400,
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Do you think there is a sexual misconduct problem at Exeter? (Female respondents)',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Participants',
      colorByPoint: true,
      data: [{
        name: 'Yes',
        y: 66.26,
      }, {
        name: 'No',
        y: 33.74,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#handled .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'If you or a friend were a survivor of sexual misconduct, how confident would you feel that the situation would be handled properly by the school?',
    },
    xAxis: {
      categories: ['Very confident', 'Confident', 'Unconfident', 'Very unconfident'],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Males',
      data: [8.27, 41.73, 35.97, 14.03],
    }, {
      name: 'Females',
      data: [3.38, 28.31, 50.77, 17.54],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#counselor .graph').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'If you were a survivor of sexual misconduct on campus, how comfortable would you feel going to a school counselor?',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Participants',
      colorByPoint: true,
      data: [{
        name: 'Very comfortable',
        y: 56,
      }, {
        name: 'Comfortable',
        y: 238,
      }, {
        name: 'Uncomfortable',
        y: 216,
      }, {
        name: 'Very uncomfortable',
        y: 89,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#globechange .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Has your level of trust in the school administration changed since the Boston Globe\'s reporting of sexual misconduct at Exeter?',
    },
    xAxis: {
      categories: ['Preps', 'Lowers', 'Uppers', 'Seniors'],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: true,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Less trusting',
      data: [59.66, 73.19, 79.49, 86.59],
    }, {
      name: 'More trusting',
      data: [40.34, 26.81, 20.51, 13.41],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
 $('#globehandled .graph').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'How do you feel the school handled the specific case initially reported on by the Boston Globe?',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of respondents',
      colorByPoint: true,
      data: [{
        name: 'Very well',
        y: 3.45,
      }, {
        name: 'Well',
        y: 22.37,
      }, {
        name: 'Poorly',
        y: 40.95,
      }, {
        name: 'Very poorly',
        y: 33.22,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#globeresponse .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'How do you feel the school has responded after The Boston Globe and others reported on Exeter and sexual misconduct this year?',
    },
    xAxis: {
      categories: ['Very well', 'Very poorly'],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: true,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [20,3],
    }, {
      name: 'Lowers',
      data: [11,10],
    }, {
      name: 'Uppers',
      data: [13,14],
    }, {
      name: 'Seniors',
      data: [8,43],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  $('#globeobject .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'How satisfied are you with the content/objectivity of The Boston Globe\'s reporting on Exeter?',
    },
    xAxis: {
      categories: ['Very Satisfied', 'Satisfied', 'Unsatisfied', "Very Unsatisfied"],
    },
    yAxis: {
      min: 0,
      text: 'Number of participants',
    },
    legend: {
      reversed: true,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [7,52,49,12],
    }, {
      name: 'Lowers',
      data: [4,62,58,20],
    }, {
      name: 'Uppers',
      data: [5,53,59,41],
    }, {
      name: 'Seniors',
      data: [5,62,75,40],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  
  $('#admintrans .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Keeping in mind the limitations administrators face due to pending investigations, how satisfied are you currently with the transparency of the school administration?',
    },
    xAxis: {
      categories: ['Very Satisfied', 'Satisfied', 'Unsatisfied', 'Very Unsatisfied'],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: true,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [10,62,4,8],
    }, {
      name: 'Lowers',
      data: [7,69,44,25],
    }, {
      name: 'Uppers',
      data: [8,64,58,30],
    }, {
      name: 'Seniors',
      data: [6,59,74,47],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  $('#futurecases .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'How confident do you feel that the school would responsibly handle future sexual misconduct cases if they occurred on campus?',
    },
    xAxis: {
      categories: ['Very Confident', 'Confident', 'Unconfident', "Very Unconfident"],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: true,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [25,61,30,4],
    }, {
      name: 'Lowers',
      data: [14,72,49,10],
    }, {
      name: 'Uppers',
      data: [18,62,60,19],
    }, {
      name: 'Seniors',
      data: [16,72,66,31],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#adminbias .graph1').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Do you think the way in which the Academy responds to sexual misconduct cases is biased towards females or males? (Male respondents)',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of participants',
      colorByPoint: true,
      data: [{
        name: 'Yes, in favor of females',
        y: 60.73,
      }, {
        name: 'Yes, in favor of males',
        y: 8.36,
      }, {
        name: 'No, unbiased',
        y: 30.91,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#adminbias .graph2').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Do you think the way in which the Academy responds to sexual misconduct cases is biased towards females or males? (Female respondents)',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
     dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of participants',
      colorByPoint: true,
      data: [{
        name: 'Yes, in favor of females',
        y: 26.85,
      }, {
        name: 'Yes, in favor of males',
        y: 28.70,
      }, {
        name: 'No, unbiased',
        y: 44.44,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  $('#vsadd .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Do you feel that the section in the E-Book on principal’s discretion is an appropriate way to handle the sexual misconduct cases that may arise on campus?',
    },
    xAxis: {
      categories: ['Yes, it will help reduce occurrences of sexual misconduct', 'No, it will not help reduce occurrences misconduct'],
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: true,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [99,20],
    }, {
      name: 'Lowers',
      data: [110, 33],
    }, {
      name: 'Uppers',
      data: [127,30],
    }, {
      name: 'Seniors',
      data: [130, 51],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  $('#whohandle .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Who do you think should handle sexual misconduct cases that are reported?',
    },
    xAxis: {
      categories: ['Discipline committee','School principal','A faculty council elected by student','A faculty council elected by faculty','A student council elected by students','A student council elected by faculty']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [67, 56, 44, 44, 22, 29, 28, 11],
    }, {
      name: 'Lowers',
      data: [65, 49, 40, 66, 21, 41, 29, 12],
    }, {
      name: 'Uppers',
      data: [72, 72, 57, 61, 43, 25, 32, 13],
    }, {
      name: 'Seniors',
      data: [64, 66, 68, 93, 45, 52, 32, 26],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  $('#knowvictim .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Do you know a friend who has been a victim of sexual misconduct at Exeter?',
    },
    xAxis: {
      categories: ['Yes', 'No']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Males',
      data: [29.93, 70.07],
    }, {
      name: 'Females',
      data: [50.61, 49.39],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  
  $('#arevictim .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Are you a victim of sexual misconduct?',
    },
    xAxis: {
      categories: ['Yes', 'No']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Males',
      data: [3.30, 96.70],
    }, {
      name: 'Females',
      data: [16.31, 83.69],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  
  $('#victimsinceexeter .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Have you been a victim of sexual misconduct since you\'ve come to Exeter?',
    },
    xAxis: {
      categories: ['Not applicable', 'Yes', 'No']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [38, 4, 77],
    }, {
      name: 'Lowers',
      data: [43, 7, 92],
    }, {
      name: 'Uppers',
      data: [54, 12, 91],
    }, {
      name: 'Seniors',
      data: [63, 21, 99],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  
  
  $('#misconductoncampus .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'If yes, did the misconduct occur on campus?',
    },
    xAxis: {
      categories: ['No, not on campus', 'Yes, on campus']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [4, 4]
    }, {
      name: 'Lowers',
      data: [7,9],
    }, {
      name: 'Uppers',
      data: [5,9],
    }, {
      name: 'Seniors',
      data: [7, 17],
    }],
    tooltip: { valueSuffix: '%' },
  });
  
  $('#typemisconduct .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'Please specify the type of sexual misconduct of which you were a victim.',
    },
    xAxis: {
      categories: ['Completed penetration', 'Attempted penetration', 'Completed sexual contact', 'Attempted sexual contact']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Males',
      data: [1.87, 0.37, 1.49, 1.12]
    }, {
      name: 'Females',
      data: [5.36, 2.21, 3.79, 4.73],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#reported .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'If you are a victim of sexual misconduct at Exeter, did you report the incident to the Exeter administration?',
    },
    xAxis: {
      text: 'Number of respondents',
      categories: ['Yes', 'No']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Males',
      data: [0, 8]
    }, {
      name: 'Females',
      data: [5, 27],
    }],
    tooltip: { valueSuffix: ' respondents' },
  });
  $('#reportexperience .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'If you answered yes to the above question, how would you characterize your experience reporting the incident to the Exeter administration?',
    },
    xAxis: {
      categories: ['Not applicable', 'Very positive', 'Positive', 'Negative', 'Very negative']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [110, 0, 0, 1, 1]
    }, {
      name: 'Lowers',
      data: [132, 0, 1, 0, 1],
    }, {
      name: 'Uppers',
      data: [150, 1, 0, 0, 0],
    }, {
      name: 'Seniors',
      data: [175, 1, 0, 1, 1],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#casehandled .graph').highcharts({
    chart: {
      type: 'bar',
    },
    title: {
      text: 'How well do you think the administration handled your case?',
    },
    xAxis: {
      categories: ['Not applicable', 'Very well', 'Well', 'Poorly', 'Very poorly']
    },
    yAxis: {
      min: 0,
      text: 'Percentage of participants',
    },
    legend: {
      reversed: false,
    },
    plotOptions: {
      series: {
        stacking: 'normal',
      },
    },
    series: [{
      name: 'Preps',
      data: [112, 0, 0, 1, 0]
    }, {
      name: 'Lowers',
      data: [132, 0, 1, 0, 2],
    }, {
      name: 'Uppers',
      data: [151, 1, 1, 0, 0],
    }, {
      name: 'Seniors',
      data: [173, 0, 1, 1, 1],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#trust .graph1').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
    },
    title: {
      text: 'Was your case reported to the police?',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of participants',
      colorByPoint: true,
      data: [{
        name: 'Yes',
        y: 37.5,
      }, {
        name: 'No',
        y: 62.5,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#police .graph').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
      width: 470,
      height: 400,
    },
    title: {
      text: 'How confident do you feel that the school would responsibly handle future sexual misconduct cases if they occurred on campus?',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of participants',
      colorByPoint: true,
      data: [{
        name: 'Very confident',
        y: 12.13,
      }, {
        name: 'Confident',
        y: 43.93,
      }, {
        name: 'Unconfident',
        y: 33.44,
      }, {
        name: 'Very unconfident',
        y: 10.49,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('#trust .graph2').highcharts({
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie',
      width: 470,
      height: 400,
    },
    title: {
      text: 'For past victims who did not report: if you never reported, would you consider coming forward now?',
    },
    plotOptions: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<strong>{point.name}</strong>: {point.percentage:.1f} %',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
        },
      },
    },
    series: [{
      name: 'Percentage of participants',
      colorByPoint: true,
      data: [{
        name: 'Yes',
        y: 9.49,
      }, {
        name: 'No',
        y: 89.40,
      }],
    }],
    tooltip: { valueSuffix: '%' },
  });
  $('.commentary.expandable').hover(function () {
    $(this).animate({ minWidth: '+=200'});
  }, function () {
    $(this).animate({ minWidth: '-=200'});
  });
});
