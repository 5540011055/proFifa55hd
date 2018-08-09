$(document).ready(function() {

   
    $('#adminTable').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	
        	
        	  subject: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกหัวข้อ'
                      },
                      stringLength: {
                          min: 2,
                          message: ' '
                      }
                  }
              },
              
              subject_en: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกหัวข้อ (ภาษาอังกฤษ)'
                      },
                      stringLength: {
                          min: 2,
                          message: ' '
                      }
                  }
              },
              
              
              keyword: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอก Keyword'
                      }
                  }
              },
              
              code: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกรหัส'
                      }
                  }
              },
              /*
              start_date : {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาระบุวันที่เริ่มต้น'
                      }
                  }
              },
              
              end_date: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาระบุวันที่สิ้นสุด'
                      }
                  }
              },*/
              
              branch: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากอกสาขาภาษาไทย'
                      }
                  }
              },
              
              branch_en: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกสาขาภาษาอังกฤษ'
                      }
                  }
              },
              
              
              account_number: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกเลขที่บัญชี'
                      },
                      numeric: {
                          message: 'กรุณากรอกเลขที่บัญชีให้ถูกต้อง'
                      }
                  }
              },
              
              
              weight: {
                  validators: {
                      
                      numeric: {
                          message: 'กรุณากรอกน้ำหนัก'
                      }
                  }
              },
              
              type: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาเลือกประเภท'
                      }   
                  }
              }, 
              
              th_lang: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกคำภาษาไทย'
                      }
                  }
              },
              
              en_lang: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกคำภาษาอังกฤษ'
                      }
                  }
              },
              
              normal_price: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาระบุราคาปกติ'
                      },
                      numeric: {
                          message: 'กรุณาระบุราคาให้ถูกต้อง'
                      }
                  }
              },
              
              
              duedate: {
                  validators: { 
                	  notEmpty: {
                          message: 'กรุณาระบุจำนวนวัน'
                      },
                      numeric: {
                          message: ''
                      }
                  }
              },
               
              
              special_price: {
                  validators: {        
                      numeric: {
                          message: 'กรุณาระบุราคาให้ถูกต้อง'
                      }
                  }
              },
              
              'th_lang[]': {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาแปลภาษาไทย'
                      }
                  }
              },
              
              'en_lang[]': {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาแปลภาษาอังกฤษ'
                      }
                  }
              },
              
              'key_word[]': {
                  validators: {
                      notEmpty: {
                          message: 'กรุณาระบุ Keyword'
                      }
                  }
              },
              
              title: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกคำอธิบาย'
                      },
                      stringLength: {
                          min: 4,
                          message: ' '
                      }
                  }
              },
              
              title_en: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกคำอธิบาย (ภาษาอังกฤษ)'
                      },
                      stringLength: {
                          min: 4,
                          message: ' '
                      }
                  }
              },
              
              cate_name: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกชื่อประเภท'
                      },
                      stringLength: {
                          min: 2,
                          message: ' '
                      }
                  }
              },
              
              cate_name_en: {
                  validators: {
                      notEmpty: {
                          message: 'กรุณากรอกชื่อประเภท (ภาษาอังกฤษ)'
                      },
                      stringLength: {
                          min: 2,
                          message: ' '
                      }
                  }
              },
        	
           
            cid: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกประเภท'
                    }   
                }
            }, 
            
          
            max_upload_filesize: {
                validators: {
                	numeric: {
                        message: 'กรุณาระบุจำนวน (MB)'
                    }
                }
            },
            
            max_upload_imagesize: {
                validators: {
                	numeric: {
                        message: 'กรุณาระบุจำนวน (MB)'
                    }
                }
            },
            
            max_upload_vdosize: {
                validators: {
                	numeric: {
                        message: 'กรุณาระบุจำนวน (MB)'
                    }
                }
            },
            
            version: {
                validators: {
                	numeric: {
                        message: 'กรุณาระบุจำนวน (MB)'
                    }
                }
            },
            
            
            
            position: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาระบุตำแหน่งพนักงาน'
                    }
                }
            },
            
            
            fullname: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอก ชื่อ - สกุล'
                    }
                }
            },
            
            priv: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาระบุสิทธิใช้งานระบบ'
                    }
                }
            },
          
            userclass: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาระบุกลุ่มผู้ใช้'
                    }
                }
            },
            
            class_value: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาระบุกลุ่มผู้ใช้'
                    }
                }
            },
            
            class_name: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาระบุชื่อกลุ่มผู้ใช้'
                    }
                }
            },
            
            address: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกที่อยู่'
                    }
                }
            },
            
            province: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกจังหวัด'
                    }
                }
            },
            
            amphur: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกอำเภอ'
                    }
                }
            },
            
            district: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาเลือกตำบล'
                    }
                }
            },
            
            
            username: {
                validators: {
                    notEmpty: {
                        message: 'กรุณาระบุชื่อผู้ใช้'
                    }
                }
            },
            
            password: {
            	validators: {
            		 notEmpty: {
                         message: 'กรุณาระบุรหัสผ่าน'
                     },stringLength: {
                         min: 5,
                         message: 'กำหนดรหัสผ่านอย่างน้อย 5 อักษร'
                     }
                }
            },
            
            repassword: {
            	validators: {
            		 notEmpty: {
                         message: 'กรุณายืนยันรหัสผ่าน'
                     },
                    identical: {
                        field: 'password',
                        message: 'กรุณายืนยันรหัสผ่าน ให้ถูกต้อง'
                    }
                }
            },
            
            
            newpassword: {
            	validators: {
            		 notEmpty: {
                         message: 'กรุณาระบุรหัสผ่านใหม่'
                     },stringLength: {
                         min: 5,
                         message: 'กำหนดรหัสผ่านอย่างน้อย 5 อักษร'
                     }
                }
            },
            
            renewpassword: {
            	validators: {
            		 notEmpty: {
                         message: 'กรุณายืนยันรหัสผ่านใหม่'
                     },
                    identical: {
                        field: 'newpassword',
                        message: 'รหัสผ่านใหม่ไม่ตรงกัน'
                    }
                }
            },
            
            
            /*postcode: {
                validators: {
                    notEmpty: {
                        message: 'กรุณากรอกรหัสไปรษณีย์'
                    },
                	numeric: {
                        message: 'กรุณากรอกรหัสไปรษณีย์ให้ถูกต้อง'
                    }
                }
            },*/
            
            email: {
                validators: {
                	notEmpty: {
                        message: 'กรุณากรอกอีเมล์'
                    },
                	 emailAddress: {
                         message: 'กรุณากรอกอีเมล์ให้ถูกต้อง'
                     }
                }
            },
            
            
            
            
        }
    });
    
   // set icon 
  /*  $("[data-fv-icon-for*='prod_group']").css( "right", "166px");
    $("[data-fv-icon-for*='asmpq_active']").css( "right", "166px");
    $("[data-fv-icon-for*='orderby']").css( "right", "166px"); */
    
});



